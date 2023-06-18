<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\ContractDetail;
use App\Models\ContractVendor;
use App\Models\ReviewLegal;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpWord\TemplateProcessor;

class ContractController extends Controller
{

    //contract buyer

    public function getBuyerContract()
    {
        $user_id = Auth::id();
        return view('auth.contract.buyer.index', [
            "contracts" => Contract::where('user_detail_id', $user_id)->get()
        ]);
    }

    public function getVendorContract()
    {
        $user_id = Auth::id();
        $vendor = Vendor::where('user_detail_id', $user_id)->first();
        $contracts = $vendor->contracts()->get();

        return view('auth.contract.vendor.index', compact('contracts'));
    }

    // public function createContractDetail(Contract $contract)
    // {
    //     return view('auth.contract.vendor.create', compact('contract'));
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeContractDetail(Request $request)
    {
        //
    }

    public function showBuyer(Contract $contract)
    {
        $contracts = Contract::find($contract->id)->vendors()->get();


        return view('auth.contract.buyer.show', compact('contract', 'contracts'));
    }

    public function detailBuyer(Contract $contract, Vendor $vendor)
    {      
   
        $contract = $contract->vendors()->where('vendor_id', $vendor->id)->first();
        $reviews = ReviewLegal::where('contract',$contract->id)->where('vendor',$vendor->id);

        return view ('auth.contract.buyer.detail', compact('contract', 'reviews'));
    }

    public function return(Contract $contract, Vendor $vendor)
    
    {
        $contracts = $contract->vendors()->where('vendor', $vendor->id);

        $contract->vendors()->updateExistingPivot($vendor->id, [
            'status_id' => 1,
        ]);

        return redirect()->back();

    }


    public function reviewLegal(Contract $contract, Vendor $vendor){
        $contracts = $contract->vendors()->where('vendor', $vendor->id);

        $contract->vendors()->updateExistingPivot($vendor->id, [
            'status_id' => 4,
        ]);

        return redirect()->back();

    }

    public function reviewAVP(Contract $contract, Vendor $vendor){
        $contracts = $contract->vendors()->where('vendor', $vendor->id);

        $contract->vendors()->updateExistingPivot($vendor->id, [
            'status_id' => 6,
        ]);

        return redirect()->back();

    }


    // contract legal

    public function getLegalContract(){
        $user_id = Auth::id();
        $contracts = ContractVendor::where('status_id', 4)->get();


        return view('auth.contract.legal.index', compact('user_id','contracts'));
    }

    //masih kurang yakin tappi bisa masuk. untuk id 3 not founf
    public function showLegal(Contract $contract)
    {
        $contracts = ContractVendor::find($contract->id);

        return view('auth.contract.legal.show', compact('contracts'));
    }



    public function storeReview(Request $request, Contract $contract, Vendor $vendor)
    {

        // dd($reviews);
        // dd($vendor);
        $reviews = ReviewLegal::create([
            'contract_id' => $contract->id,
            'user_id' => Auth()->id(),
            'status_id' => $request->status_id,
            'vendor_id' => $vendor->id,
            'review_contract' => $request->review_contract,
        ]);

        $contractvendor = ContractVendor::where('contract_id', $contract->id)->where('vendor_id', $vendor->id)
            ->update([
            'status_id' => $request->status_id,
            'review_id' => $reviews->id,
        ]); 

        // dd($reviews,$contractvendor);
        return redirect()->route('contract.legal-show', $contract->id );

    }



//ini kalau ga salah ga jadi
    // public function returnLegal(Contract $contract, Vendor $vendor){
    //     $contracts = $contract->vendor()->where('vendor', $vendor->id);

    //     $contract->vendors()->update($contract->id, [
    //         'status_id' => 3,
    //     ]);

    //     return redirect()->back();

    // }  


    // contract avp
    
    public function getAvpContract(){
        $user_id = Auth::id();
        $contracts = ContractVendor::where('status_id', 6)->get();


        return view('auth.contract.approval.avp.index', compact('user_id','contracts'));
    }

    // contract vendor

    public function showVendor(Contract $contract)
    {
        $contracts = $contract->vendors()->get();

        return view('auth.contract.vendor.show', compact('contract', 'contracts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editContractDetail(Contract $contract)
    {
        $number = "";
        $director = "";
        $phone = "";
        $address = "";

        foreach ($contract->vendors as $vendor) {
            $number = $vendor->pivot->number;
            $director = $vendor->pivot->director;
            $phone = $vendor->pivot->phone;
            $address = $vendor->pivot->address;
        }

        return view('auth.contract.vendor.edit', compact('contract', 'number', 'director', 'phone', 'address'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateContractDetail(Request $request, Contract $contract)
    {
        $request->validate([
            'number' => 'required',
            'director' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ]);

        $templateProcessor = new TemplateProcessor('word-template/template-kontrak.docx');
        $templateProcessor->setValue('number', $request->number);
        $templateProcessor->setValue('director', $request->director);
        $templateProcessor->setValue('phone', $request->phone);
        $templateProcessor->setValue('address', $request->address);
        $fileName = "CEK";
        $templateProcessor->saveAs($fileName . '.docx');

        $domPdfPath = base_path('vendor/dompdf/dompdf');
        \PhpOffice\PhpWord\Settings::setPdfRendererPath($domPdfPath);
        \PhpOffice\PhpWord\Settings::setPdfRendererName('DomPDF'); 
        $Content = \PhpOffice\PhpWord\IOFactory::load(public_path('CEK.docx')); 
        $PDFWriter = \PhpOffice\PhpWord\IOFactory::createWriter($Content,'PDF');
        $PDFWriter->save(public_path('CEK.pdf')); 

        $user_id = Auth::id();
        $vendor = Vendor::where('user_detail_id', $user_id)->first();

        $work = Contract::find($contract->id);

        $work->vendors()->updateExistingPivot($vendor->id, [
            'status_id' => 2,
            'number' => $request->number,
            'director' => $request->director,
            'phone' => $request->phone,
            'address' => $request->address,
            'filename' => $fileName,
        ]);

        // return redirect()->back();
        return redirect('contract/vendor');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
