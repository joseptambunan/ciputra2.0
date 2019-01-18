<?php

namespace Modules\Report\Http\Controllers;
//require_once base_path().'/vendor/phpoffice/phppresentation/samples/Sample_Header.php';


use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Project\Entities\Project;
use Modules\Budget\Entities\Budget;
use Modules\Budget\Entities\BudgetDetail;
use Modules\Budget\Entities\BudgetTahunan;
use Modules\Budget\Entities\BudgetTahunanPeriode;

use PhpOffice\PhpPresentation\PhpPresentation;
use PhpOffice\PhpPresentation\IOFactory;
use PhpOffice\PhpPresentation\Style\Color;
use PhpOffice\PhpPresentation\Style\Alignment;
use PhpOffice\PhpPresentation\Style\Fill;
use PhpOffice\PhpPresentation\Style\Border;
use PhpOffice\PhpPresentation\Shape\Chart\Gridlines;
use PhpOffice\PhpPresentation\Shape\Chart\Type\Area;
use PhpOffice\PhpPresentation\Shape\Chart\Type\Bar;
use PhpOffice\PhpPresentation\Shape\Chart\Type\Bar3D;
use PhpOffice\PhpPresentation\Shape\Chart\Type\Line;
use PhpOffice\PhpPresentation\Shape\Chart\Type\Pie;
use PhpOffice\PhpPresentation\Shape\Chart\Type\Pie3D;
use PhpOffice\PhpPresentation\Shape\Chart\Type\Scatter;
use PhpOffice\PhpPresentation\Shape\Chart\Series;
use PhpOffice\PhpPresentation\Style\Shadow;
use Modules\Project\Entities\HppConCostDetailReport;

class RakorController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(Request $request)
    {
        $user = \Auth::user();
        $project = Project::find($request->id);
        return view('report::report.report_rakor',compact("user","project"));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create(Request $request)
    {
        global $oFill;
        global $oShadow;

        //echo __DIR__ ; die;
        $project = Project::find($request->id);
        $colorBlack = new Color( 'FFE06B20' ) ;
        $objPHPPowerPoint = new PhpPresentation();
        for ( $i=0; $i<22; $i++ ){            
            $slide = $objPHPPowerPoint->createSlide();
            $shape = $slide->createRichTextShape();
            $shape->setHeight(200);
            $shape->setWidth(600);
            $shape->setOffsetX(150);
            $shape->setOffsetY(30);
            $shape->getActiveParagraph()->getAlignment()->setHorizontal( Alignment::HORIZONTAL_LEFT );
            $textRun = $shape->createTextRun($project->name);
            $textRun->getFont()->setBold(true);
            $textRun->getFont()->setSize(20);
            $textRun->getFont()->setColor($colorBlack);
            $shape->createBreak();

            if ( $i == 0 ){ 
                $shape->setHeight(200);
                $shape->setWidth(600);
                $shape->setOffsetX(300);
                $shape->setOffsetY(300);
                $shape->getActiveParagraph()->getAlignment()->setHorizontal( Alignment::HORIZONTAL_LEFT );
                $textRun = $shape->createTextRun('TEKNIK DAN QUANTITY SURVEYOR');
                $textRun->getFont()->setBold(true);
                $textRun->getFont()->setSize(32);
                $textRun->getFont()->setColor($colorBlack);
                $shape->createBreak();
            }elseif ( $i == 1 ){

                $shape = $slide->createRichTextShape();
                $shape->setHeight(200);
                $shape->setWidth(600);
                $shape->setOffsetX(450);
                $shape->setOffsetY(30);
                $shape->getActiveParagraph()->getAlignment()->setHorizontal( Alignment::HORIZONTAL_LEFT );
                $textRun = $shape->createTextRun("| BUDGET vs REALISASI ".date("Y"));
                $textRun->getFont()->setBold(true);
                $textRun->getFont()->setSize(20);
                $textRun->getFont()->setColor($colorBlack);
                $shape->createBreak();

                $shape = $slide->createRichTextShape();
                $shape->setHeight(200);
                $shape->setWidth(900);
                $shape->setOffsetX(250);
                $shape->setOffsetY(100);
                $shape->getActiveParagraph()->getAlignment()->setHorizontal( Alignment::HORIZONTAL_LEFT );
                $textRun = $shape->createTextRun('TOTAL BUDGET : Rp. '. number_format($project->nilai_budget_before));
                $textRun->getFont()->setBold(true);
                $textRun->getFont()->setSize(24);
                $textRun->getFont()->setColor($colorBlack);
                $shape->createBreak();

                $shape = $slide->createRichTextShape();
                $shape->setHeight(200);
                $shape->setWidth(900);
                $shape->setOffsetX(250);
                $shape->setOffsetY(140);
                $shape->getActiveParagraph()->getAlignment()->setHorizontal( Alignment::HORIZONTAL_LEFT );
                $textRun = $shape->createTextRun('DEVELOPMENT COST : Rp. '. number_format($project->nilai_budget_before ));
                $textRun->getFont()->setBold(true);
                $textRun->getFont()->setSize(24);
                $textRun->getFont()->setColor($colorBlack);
                $shape->createBreak();

                $shape = $slide->createRichTextShape();
                $shape->setHeight(200);
                $shape->setWidth(900);
                $shape->setOffsetX(250);
                $shape->setOffsetY(180);
                $shape->getActiveParagraph()->getAlignment()->setHorizontal( Alignment::HORIZONTAL_LEFT );
                $textRun = $shape->createTextRun('CONSTRUCTION COST : Rp. '. number_format($project->nilai_budget_before));
                $textRun->getFont()->setBold(true);
                $textRun->getFont()->setSize(24);
                $textRun->getFont()->setColor($colorBlack);
                $shape->createBreak();

                $shape = $slide->createRichTextShape();
                $shape->setHeight(200);
                $shape->setWidth(900);
                $shape->setOffsetX(20);
                $shape->setOffsetY(80);
                $shape->getActiveParagraph()->getAlignment()->setHorizontal( Alignment::HORIZONTAL_LEFT );
                $textRun = $shape->createTextRun('BUDGET') ;
                $textRun->getFont()->setBold(true);
                $textRun->getFont()->setSize(30);
                $textRun->getFont()->setColor($colorBlack);
                $shape->createBreak();

                $shape = $slide->createRichTextShape();
                $shape->setHeight(200);
                $shape->setWidth(900);
                $shape->setOffsetX(20);
                $shape->setOffsetY(120);
                $shape->getActiveParagraph()->getAlignment()->setHorizontal( Alignment::HORIZONTAL_LEFT );
                $textRun = $shape->createTextRun(date('Y')) ;
                $textRun->getFont()->setBold(true);
                $textRun->getFont()->setSize(38);
                $textRun->getFont()->setColor($colorBlack);
                $shape->createBreak();

                $shape = $slide->createRichTextShape();
                $shape->setHeight(200);
                $shape->setWidth(900);
                $shape->setOffsetX(20);
                $shape->setOffsetY(180);
                $shape->getActiveParagraph()->getAlignment()->setHorizontal( Alignment::HORIZONTAL_LEFT );
                $textRun = $shape->createTextRun('1Jan-31Des'.date('Y')) ;
                $textRun->getFont()->setBold(true);
                $textRun->getFont()->setSize(18);
                $textRun->getFont()->setColor($colorBlack);
                $shape->createBreak();

                $shape = $slide->createRichTextShape();
                $shape->setHeight(200);
                $shape->setWidth(900);
                $shape->setOffsetX(20);
                $shape->setOffsetY(250);
                $shape->getActiveParagraph()->getAlignment()->setHorizontal( Alignment::HORIZONTAL_LEFT );
                $textRun = $shape->createTextRun('REALISASI') ;
                $textRun->getFont()->setBold(true);
                $textRun->getFont()->setSize(30);
                $textRun->getFont()->setColor($colorBlack);
                $shape->createBreak();

                $shape = $slide->createRichTextShape();
                $shape->setHeight(200);
                $shape->setWidth(900);
                $shape->setOffsetX(20);
                $shape->setOffsetY(290);
                $shape->getActiveParagraph()->getAlignment()->setHorizontal( Alignment::HORIZONTAL_LEFT );
                $textRun = $shape->createTextRun(date('Y')) ;
                $textRun->getFont()->setBold(true);
                $textRun->getFont()->setSize(38);
                $textRun->getFont()->setColor($colorBlack);
                $shape->createBreak();

                $shape = $slide->createRichTextShape();
                $shape->setHeight(200);
                $shape->setWidth(900);
                $shape->setOffsetX(20);
                $shape->setOffsetY(340);
                $shape->getActiveParagraph()->getAlignment()->setHorizontal( Alignment::HORIZONTAL_LEFT );
                $textRun = $shape->createTextRun('1Jan-31Des'.date('Y')) ;
                $textRun->getFont()->setBold(true);
                $textRun->getFont()->setSize(18);
                $textRun->getFont()->setColor($colorBlack);
                $shape->createBreak();

                $shape = $slide->createRichTextShape();
                $shape->setHeight(200);
                $shape->setWidth(900);
                $shape->setOffsetX(250);
                $shape->setOffsetY(250);
                $shape->getActiveParagraph()->getAlignment()->setHorizontal( Alignment::HORIZONTAL_LEFT );
                $textRun = $shape->createTextRun('TOTAL REALISASI : Rp. '. number_format($project->nilai_rakor_terbayar_dev_cost + $project->nilai_rakor_terbayar_con_cost));
                $textRun->getFont()->setBold(true);
                $textRun->getFont()->setSize(24);
                $textRun->getFont()->setColor($colorBlack);
                $shape->createBreak();

                $shape = $slide->createRichTextShape();
                $shape->setHeight(200);
                $shape->setWidth(900);
                $shape->setOffsetX(250);
                $shape->setOffsetY(290);
                $shape->getActiveParagraph()->getAlignment()->setHorizontal( Alignment::HORIZONTAL_LEFT );
                $textRun = $shape->createTextRun('DEVELOPMENT COST : Rp. '. number_format($project->nilai_rakor_terbayar_dev_cost));
                $textRun->getFont()->setBold(true);
                $textRun->getFont()->setSize(24);
                $textRun->getFont()->setColor($colorBlack);
                $shape->createBreak();

                $shape = $slide->createRichTextShape();
                $shape->setHeight(200);
                $shape->setWidth(900);
                $shape->setOffsetX(250);
                $shape->setOffsetY(330);
                $shape->getActiveParagraph()->getAlignment()->setHorizontal( Alignment::HORIZONTAL_LEFT );
                $textRun = $shape->createTextRun('CONSTRUCTION COST : Rp. '. number_format($project->nilai_rakor_terbayar_con_cost));
                $textRun->getFont()->setBold(true);
                $textRun->getFont()->setSize(24);
                $textRun->getFont()->setColor($colorBlack);
                $shape->createBreak();

            } elseif ( $i == 2 ){
                $arrayBulananCashOut = array(
                    "januari" => 0,
                    "februari" => 0,
                    "maret" => 0,
                    "april" => 0,
                    "mei" => 0,
                    "juni" => 0,
                    "juli" => 0,
                    "agustus" => 0,
                    "september" => 0,
                    "oktober" => 0,
                    "november" => 0,
                    "desember" => 0
                );

                $arrayCarryOverCashOut = array(
                    "januari" => 0,
                    "februari" => 0,
                    "maret" => 0,
                    "april" => 0,
                    "mei" => 0,
                    "juni" => 0,
                    "juli" => 0,
                    "agustus" => 0,
                    "september" => 0,
                    "oktober" => 0,
                    "november" => 0,
                    "desember" => 0
                );

                $shape = $slide->createRichTextShape();
                $shape->setHeight(200);
                $shape->setWidth(600);
                $shape->setOffsetX(450);
                $shape->setOffsetY(30);
                $shape->getActiveParagraph()->getAlignment()->setHorizontal( Alignment::HORIZONTAL_LEFT );
                $textRun = $shape->createTextRun("| BUDGET vs REALISASI ".date("Y"));
                $textRun->getFont()->setBold(true);
                $textRun->getFont()->setSize(20);
                $textRun->getFont()->setColor($colorBlack);
                $shape->createBreak();

                $shape = $slide->createRichTextShape();
                $shape->setHeight(200);
                $shape->setWidth(600);
                $shape->setOffsetX(470);
                $shape->setOffsetY(60);
                $shape->getActiveParagraph()->getAlignment()->setHorizontal( Alignment::HORIZONTAL_LEFT );
                $textRun = $shape->createTextRun("DEVCOST & CON COST");
                $textRun->getFont()->setBold(true);
                $textRun->getFont()->setSize(18);
                $textRun->getFont()->setColor($colorBlack);
                $shape->createBreak();

                $shape = $slide->createTableShape(14);
                $shape->setHeight(200);
                $shape->setWidth(900);
                $shape->setOffsetX(20);
                $shape->setOffsetY(450);


                foreach ($project->budget_tahunans as $key => $value) {
                    /*if ( $value->tahun_anggaran == date("Y")){
                        //Budget SPK 
                        foreach ($value->details as $key2 => $value2) {
                            $budget_cf = BudgetTahunanPeriode::where("budget_id",$value->id)->where("itempekerjaan_id",$value2->itempekerjaans->id)->get();
                            if ( count($budget_cf) > 0 ){
                                $spk = $value2->volume * $value2->nilai;
                                foreach ($budget_cf as $key3 => $value3) {

                                    $arrayBulananCashOut["januari"] =  $arrayBulananCashOut["januari"] + (($value3->januari/100) * $spk);
                                    $arrayBulananCashOut["februari"] = $arrayBulananCashOut["februari"] + (($value3->februari/100) * $spk);
                                    $arrayBulananCashOut["maret"] = $arrayBulananCashOut["maret"] + (($value3->maret/100) * $spk);
                                    $arrayBulananCashOut["april"] = $arrayBulananCashOut["april"] + (($value3->april/100) * $spk);
                                    $arrayBulananCashOut["mei"] = $arrayBulananCashOut["mei"] + (($value3->mei/100) * $spk);
                                    $arrayBulananCashOut["juni"] = $arrayBulananCashOut["juni"] + (($value3->juni/100) * $spk);
                                    $arrayBulananCashOut["juli"] = $arrayBulananCashOut["juli"] + (($value3->juli/100) * $spk);
                                    $arrayBulananCashOut["agustus"] = $arrayBulananCashOut["agustus"] + (($value3->agustus/100) * $spk);
                                    $arrayBulananCashOut["september"] = $arrayBulananCashOut["september"] + (($value3->september/100) * $spk);
                                    $arrayBulananCashOut["oktober"] = $arrayBulananCashOut["oktober"] + (($value3->oktober/100) * $spk);
                                    $arrayBulananCashOut["november"] = $arrayBulananCashOut["november"] + (($value3->november/100) * $spk);
                                    $arrayBulananCashOut["desember"] = $arrayBulananCashOut["desember"] + (($value3->desember/100) * $spk);
                                }
                            }
                        }

                        //Budget Carry Over 
                        foreach ($value->carry_over as $key3 => $value3) {
                            $sisa = $value3->spk->nilai - $value3->spk->terbayar_verified;
                            foreach ($value3->cash_flows as $key4 => $value4) {
                                $arrayCarryOverCashOut["januari"] =  $arrayCarryOverCashOut["januari"] + (($value4->januari/100) * $sisa);
                                $arrayCarryOverCashOut["februari"] = $arrayCarryOverCashOut["februari"] + (($value4->februari/100) * $sisa);
                                $arrayCarryOverCashOut["maret"] = $arrayCarryOverCashOut["maret"] + (($value4->maret/100) * $sisa);
                                $arrayCarryOverCashOut["april"] = $arrayCarryOverCashOut["april"] + (($value4->april/100) * $sisa);
                                $arrayCarryOverCashOut["mei"] = $arrayCarryOverCashOut["mei"] + (($value4->mei/100) * $sisa);
                                $arrayCarryOverCashOut["juni"] = $arrayCarryOverCashOut["juni"] + (($value4->juni/100) * $sisa);
                                $arrayCarryOverCashOut["juli"] = $arrayCarryOverCashOut["juli"] + (($value4->juli/100) * $sisa);
                                $arrayCarryOverCashOut["agustus"] = $arrayCarryOverCashOut["agustus"] + (($value4->agustus/100) * $sisa);
                                $arrayCarryOverCashOut["september"] = $arrayCarryOverCashOut["september"] + (($value4->september/100) * $sisa);
                                $arrayCarryOverCashOut["oktober"] = $arrayCarryOverCashOut["oktober"] + (($value4->oktober/100) * $sisa);
                                $arrayCarryOverCashOut["november"] = $arrayCarryOverCashOut["november"] + (($value4->november/100) * $sisa);
                                $arrayCarryOverCashOut["desember"] = $arrayCarryOverCashOut["desember"] + (($value4->desember/100) * $sisa);
                            }
                        }
                    }*/
                }
                //Get Realisasi 
                $project_devcost_realisasi = $project->nilai_bulanan_report_realisasi_dev_cost;
                $project_concost_realisasi = $project->nilai_bulanan_report_realisasi_con_cost;

                for( $j=0; $j <= 5 ; $j++ ){
                    $row = $shape->createRow(); 
                    if ( $j == 1 ){
                        $row->getFill()->setFillType(Fill::FILL_SOLID)->setStartColor(new Color('#3333cc'))->setEndColor(new Color('#3333cc'));
                        $cell02 = $row->nextCell();
                        $cell02->createTextRun('Uraian')->getFont()->setBold(true)->setSize(13);
                        $cell12 = $row->nextCell();
                        $cell12->createTextRun('Jan')->getFont()->setBold(true)->setSize(13);
                        $cell22 = $row->nextCell();
                        $cell22->createTextRun('Feb')->getFont()->setBold(true)->setSize(13);
                        $cell32 = $row->nextCell();
                        $cell32->createTextRun('Mar')->getFont()->setBold(true)->setSize(13);
                        $cell42 = $row->nextCell();
                        $cell42->createTextRun('Apr')->getFont()->setBold(true)->setSize(13);
                        $cell52 = $row->nextCell();
                        $cell52->createTextRun('Mei')->getFont()->setBold(true)->setSize(13);
                        $cell62 = $row->nextCell();
                        $cell62->createTextRun('Jun')->getFont()->setBold(true)->setSize(13);
                        $cell72 = $row->nextCell();
                        $cell72->createTextRun('Jul')->getFont()->setBold(true)->setSize(13);
                        $cell82 = $row->nextCell();
                        $cell82->createTextRun('Agu')->getFont()->setBold(true)->setSize(13);
                        $cell92 = $row->nextCell();
                        $cell92->createTextRun('Sept.')->getFont()->setBold(true)->setSize(13);
                        $cell102 = $row->nextCell();
                        $cell102->createTextRun('Okt')->getFont()->setBold(true)->setSize(13);
                        $cell112 = $row->nextCell();
                        $cell112->createTextRun('Nov')->getFont()->setBold(true)->setSize(13);
                        $cell122 = $row->nextCell();
                        $cell122->createTextRun('Des')->getFont()->setBold(true)->setSize(13);
                        $cell132 = $row->nextCell();
                        $cell132->createTextRun('Total')->getFont()->setBold(true)->setSize(13);
                    }elseif ( $j == 2 ){
                        $cell02 = $row->nextCell();
                        $cell02->createTextRun('Budget');
                        $cell12 = $row->nextCell();
                        $cell12->createTextRun(number_format(($januari = $arrayBulananCashOut["januari"] + $arrayCarryOverCashOut["januari"])/1000000),2)->getFont()->setBold(true)->setSize(13);
                        $cell22 = $row->nextCell();
                        $cell22->createTextRun(number_format(($februari = $arrayBulananCashOut["februari"] + $arrayCarryOverCashOut["februari"])/1000000),2)->getFont()->setBold(true)->setSize(13);
                        $cell32 = $row->nextCell();
                        $cell32->createTextRun(number_format(($maret = $arrayBulananCashOut["maret"] + $arrayCarryOverCashOut["maret"])/1000000),2)->getFont()->setBold(true)->setSize(13);
                        $cell42 = $row->nextCell();
                        $cell42->createTextRun(number_format(($april = $arrayBulananCashOut["april"] + $arrayCarryOverCashOut["april"])/1000000),2)->getFont()->setBold(true)->setSize(13);
                        $cell52 = $row->nextCell();
                        $cell52->createTextRun(number_format(($mei = $arrayBulananCashOut["mei"] + $arrayCarryOverCashOut["mei"])/1000000),2)->getFont()->setBold(true)->setSize(13);
                        $cell62 = $row->nextCell();
                        $cell62->createTextRun(number_format(($juni = $arrayBulananCashOut["juni"] + $arrayCarryOverCashOut["juni"])/1000000),2)->getFont()->setBold(true)->setSize(13);
                        $cell72 = $row->nextCell();
                        $cell72->createTextRun(number_format(($juli = $arrayBulananCashOut["juli"] + $arrayCarryOverCashOut["juli"])/1000000),2)->getFont()->setBold(true)->setSize(13);
                        $cell82 = $row->nextCell();
                        $cell82->createTextRun(number_format(($agustus = $arrayBulananCashOut["agustus"] + $arrayCarryOverCashOut["agustus"])/1000000),2)->getFont()->setBold(true)->setSize(13);
                        $cell92 = $row->nextCell();
                        $cell92->createTextRun(number_format(($september = $arrayBulananCashOut["september"] + $arrayCarryOverCashOut["september"])/1000000),2)->getFont()->setBold(true)->setSize(13);
                        $cell102 = $row->nextCell();
                        $cell102->createTextRun(number_format(($oktober = $arrayBulananCashOut["oktober"] + $arrayCarryOverCashOut["oktober"])/1000000),2)->getFont()->setBold(true)->setSize(13);
                        $cell112 = $row->nextCell();
                        $cell112->createTextRun(number_format(($november = $arrayBulananCashOut["november"] + $arrayCarryOverCashOut["november"])/1000000),2)->getFont()->setBold(true)->setSize(13);
                        $cell122 = $row->nextCell();
                        $cell122->createTextRun(number_format(($desember = $arrayBulananCashOut["desember"] + $arrayCarryOverCashOut["desember"])/1000000),2)->getFont()->setBold(true)->setSize(13);
                        $cell132 = $row->nextCell();
                        $cell132->createTextRun(number_format(($januari + $februari + $maret + $april + $mei + $juni + $juli + $agustus + $september + $oktober + $november + $desember)/1000000),2)->getFont()->setBold(true)->setSize(13);
                    }elseif ( $j == 3 ){
                        $cell02 = $row->nextCell();
                        $cell02->createTextRun('Kumulatif Budget');
                        $cell12 = $row->nextCell();
                        $cell12->createTextRun(number_format(( $januari = $arrayBulananCashOut["januari"] + $arrayCarryOverCashOut["januari"])/1000000),2)->getFont()->setBold(true)->setSize(13);;
                        $cell22 = $row->nextCell();
                        $cell22->createTextRun(number_format(( $februari =  $januari + $arrayBulananCashOut["februari"] + $arrayCarryOverCashOut["februari"])/1000000),2)->getFont()->setBold(true)->setSize(13);
                        $cell32 = $row->nextCell();
                        $cell32->createTextRun(number_format(( $maret = $februari + $arrayBulananCashOut["maret"] + $arrayCarryOverCashOut["maret"])/1000000),2)->getFont()->setBold(true)->setSize(13);
                        $cell42 = $row->nextCell();
                        $cell42->createTextRun(number_format(( $april = $maret + $arrayBulananCashOut["april"] + $arrayCarryOverCashOut["april"])/1000000),2)->getFont()->setBold(true)->setSize(13);
                        $cell52 = $row->nextCell();
                        $cell52->createTextRun(number_format(( $mei = $april + $arrayBulananCashOut["mei"] + $arrayCarryOverCashOut["mei"])/1000000),2)->getFont()->setBold(true)->setSize(13);
                        $cell62 = $row->nextCell();
                        $cell62->createTextRun(number_format(( $juni = $mei + $arrayBulananCashOut["juni"] + $arrayCarryOverCashOut["juni"])/1000000),2)->getFont()->setBold(true)->setSize(13);
                        $cell72 = $row->nextCell();
                        $cell72->createTextRun(number_format(( $juli = $juni + $arrayBulananCashOut["juli"] + $arrayCarryOverCashOut["juli"])/1000000),2)->getFont()->setBold(true)->setSize(13);
                        $cell82 = $row->nextCell();
                        $cell82->createTextRun(number_format(( $agustus = $juli + $arrayBulananCashOut["agustus"] + $arrayCarryOverCashOut["agustus"])/1000000),2)->getFont()->setBold(true)->setSize(13);
                        $cell92 = $row->nextCell();
                        $cell92->createTextRun(number_format(( $september = $agustus + $arrayBulananCashOut["september"] + $arrayCarryOverCashOut["september"])/1000000),2)->getFont()->setBold(true)->setSize(13);
                        $cell102 = $row->nextCell();
                        $cell102->createTextRun(number_format(( $oktober = $september + $arrayBulananCashOut["oktober"] + $arrayCarryOverCashOut["oktober"])/1000000),2)->getFont()->setBold(true)->setSize(13);
                        $cell112 = $row->nextCell();
                        $cell112->createTextRun(number_format(( $november = $oktober + $arrayBulananCashOut["november"] + $arrayCarryOverCashOut["november"])/1000000),2)->getFont()->setBold(true)->setSize(13);
                        $cell122 = $row->nextCell();
                        $cell122->createTextRun(number_format(( $desember = $november + $arrayBulananCashOut["desember"] + $arrayCarryOverCashOut["desember"])/1000000),2)->getFont()->setBold(true)->setSize(13);
                        $cell132 = $row->nextCell();
                        $cell132->createTextRun(number_format(($januari + $februari + $maret + $april + $mei + $juni + $juli + $agustus + $september + $oktober + $november + $desember)/1000000),2)->getFont()->setBold(true)->setSize(13);
                                
                    }else if ( $j == 4 ){
                        $cell02 = $row->nextCell();
                        $cell02->createTextRun('Realisasi');
                        $cell12 = $row->nextCell();
                        $cell12->createTextRun(number_format(($januari = $project_devcost_realisasi["01"] + $project_concost_realisasi["01"])/1000000),2)->getFont()->setBold(true)->setSize(13);;
                        $cell22 = $row->nextCell();
                        $cell22->createTextRun(number_format(($februari = $project_devcost_realisasi["02"] + $project_concost_realisasi["02"])/1000000),2)->getFont()->setBold(true)->setSize(13);
                        $cell32 = $row->nextCell();
                        $cell32->createTextRun(number_format(($maret = $project_devcost_realisasi["03"] + $project_concost_realisasi["03"])/1000000),2)->getFont()->setBold(true)->setSize(13);
                        $cell42 = $row->nextCell();
                        $cell42->createTextRun(number_format(($april =  $project_devcost_realisasi["04"] + $project_concost_realisasi["04"])/1000000),2)->getFont()->setBold(true)->setSize(13);
                        $cell52 = $row->nextCell();
                        $cell52->createTextRun(number_format(($mei = $project_devcost_realisasi["05"] + $project_concost_realisasi["05"])/1000000),2)->getFont()->setBold(true)->setSize(13);
                        $cell62 = $row->nextCell();
                        $cell62->createTextRun(number_format(($juni = $project_devcost_realisasi["06"] + $project_concost_realisasi["06"])/1000000),2)->getFont()->setBold(true)->setSize(13);
                        $cell72 = $row->nextCell();
                        $cell72->createTextRun(number_format(($juli = $project_devcost_realisasi["07"] + $project_concost_realisasi["07"])/1000000),2)->getFont()->setBold(true)->setSize(13);
                        $cell82 = $row->nextCell();
                        $cell82->createTextRun(number_format(($agustus = $project_devcost_realisasi["08"] + $project_concost_realisasi["08"])/1000000),2)->getFont()->setBold(true)->setSize(13);
                        $cell92 = $row->nextCell();
                        $cell92->createTextRun(number_format(($september = $project_devcost_realisasi["09"] + $project_concost_realisasi["09"])/1000000),2)->getFont()->setBold(true)->setSize(13);
                        $cell102 = $row->nextCell();
                        $cell102->createTextRun(number_format(($oktober = $project_devcost_realisasi["10"] + $project_concost_realisasi["10"])/1000000),2)->getFont()->setBold(true)->setSize(13);
                        $cell112 = $row->nextCell();
                        $cell112->createTextRun(number_format(($november = $project_devcost_realisasi["11"] + $project_concost_realisasi["11"])/1000000),2)->getFont()->setBold(true)->setSize(13);
                        $cell122 = $row->nextCell();
                        $cell122->createTextRun(number_format(($desember = $project_devcost_realisasi["12"] + $project_concost_realisasi["12"])/1000000),2)->getFont()->setBold(true)->setSize(13);
                        $cell132 = $row->nextCell();
                        $cell132->createTextRun(number_format(($desember)/1000000),2)->getFont()->setBold(true)->setSize(13);
                    }else if ( $j == 5 ){
                        $cell02 = $row->nextCell();
                        $cell02->createTextRun('Kumulatif Realisasi');
                        $cell12 = $row->nextCell();
                        $cell12->createTextRun(number_format(( $januari = $project_devcost_realisasi["01"] + $project_concost_realisasi["01"])/1000000),2)->getFont()->setBold(true)->setSize(13);;
                        $cell22 = $row->nextCell();
                        $cell22->createTextRun(number_format(( $februari =  $januari + $project_devcost_realisasi["02"] + $project_concost_realisasi["02"])/1000000),2)->getFont()->setBold(true)->setSize(13);
                        $cell32 = $row->nextCell();
                        $cell32->createTextRun(number_format(( $maret = $februari + $project_devcost_realisasi["03"] + $project_concost_realisasi["03"])/1000000),2)->getFont()->setBold(true)->setSize(13);
                        $cell42 = $row->nextCell();
                        $cell42->createTextRun(number_format(( $april = $maret + $project_devcost_realisasi["04"] + $project_concost_realisasi["04"])/1000000),2)->getFont()->setBold(true)->setSize(13);
                        $cell52 = $row->nextCell();
                        $cell52->createTextRun(number_format(( $mei = $april + $project_devcost_realisasi["05"] + $project_concost_realisasi["05"])/1000000),2)->getFont()->setBold(true)->setSize(13);
                        $cell62 = $row->nextCell();
                        $cell62->createTextRun(number_format(( $juni = $mei + $project_devcost_realisasi["06"] + $project_concost_realisasi["06"])/1000000),2)->getFont()->setBold(true)->setSize(13);
                        $cell72 = $row->nextCell();
                        $cell72->createTextRun(number_format(( $juli = $juni + $project_devcost_realisasi["07"] + $project_concost_realisasi["07"])/1000000),2)->getFont()->setBold(true)->setSize(13);
                        $cell82 = $row->nextCell();
                        $cell82->createTextRun(number_format(( $agustus = $juli + $project_devcost_realisasi["08"] + $project_concost_realisasi["08"])/1000000),2)->getFont()->setBold(true)->setSize(13);
                        $cell92 = $row->nextCell();
                        $cell92->createTextRun(number_format(( $september = $agustus + $project_devcost_realisasi["09"] + $project_concost_realisasi["09"])/1000000),2)->getFont()->setBold(true)->setSize(13);
                        $cell102 = $row->nextCell();
                        $cell102->createTextRun(number_format(( $oktober = $september + $project_devcost_realisasi["10"] + $project_concost_realisasi["10"])/1000000),2)->getFont()->setBold(true)->setSize(13);
                        $cell112 = $row->nextCell();
                        $cell112->createTextRun(number_format(( $november = $oktober + $project_devcost_realisasi["11"] + $project_concost_realisasi["11"])/1000000),2)->getFont()->setBold(true)->setSize(13);
                        $cell122 = $row->nextCell();
                        $cell122->createTextRun(number_format(( $desember = $november + $project_devcost_realisasi["12"] + $project_concost_realisasi["12"])/1000000),2)->getFont()->setBold(true)->setSize(13);
                        $cell132 = $row->nextCell();
                        $cell132->createTextRun(number_format(($desember)/1000000),2)->getFont()->setBold(true)->setSize(13);
                    }
                }
            }
        }
       
        $oWriterPPTX = IOFactory::createWriter($objPHPPowerPoint, 'PowerPoint2007');
        $filename = "Project_".$project->name."_".strtotime("now");
        $oWriterPPTX->save($filename.".pptx");


        $file= public_path(). "";  //path of your directory
        $headers = array(
            'Content-Type: application/pdf',
        );
        return response()->download($filename.".pptx");
        //return Response::download('CV.pdf', 'CV.pdf', $headers);
        //return view('report::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('report::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('report::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }
}
