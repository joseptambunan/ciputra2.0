elseif ( $i == 2 ){
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
                    if ( $value->tahun_anggaran == date("Y")){
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
                    }
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
            }elseif ( $i == 3 ){
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
                $textRun = $shape->createTextRun("DEVCOST ");
                $textRun->getFont()->setBold(true);
                $textRun->getFont()->setSize(18);
                $textRun->getFont()->setColor($colorBlack);
                $shape->createBreak();

                foreach ($project->budget_tahunans as $key => $value) {
                    if ( $value->tahun_anggaran == date("Y")){
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
                    }
                }


                //Get Realisasi 
                $project_devcost_realisasi = $project->nilai_bulanan_report_realisasi_dev_cost;
                $shape = $slide->createTableShape(14);
                $shape->setHeight(200);
                $shape->setWidth(900);
                $shape->setOffsetX(20);
                $shape->setOffsetY(450);

                for( $j=0; $j <= 5 ; $j++ ){
                    $row = $shape->createRow();
                    if ( $j == 1 ){
                        $row->getFill()->setFillType(Fill::FILL_SOLID)->setStartColor(new Color('#3333cc'))->setEndColor(new Color('#3333cc'));
                        $cell03 = $row->nextCell();
                        $cell03->createTextRun('Uraian')->getFont()->setBold(true)->setSize(13);
                        $cell13 = $row->nextCell();
                        $cell13->createTextRun('Jan')->getFont()->setBold(true)->setSize(13);
                        $cell23 = $row->nextCell();
                        $cell23->createTextRun('Feb')->getFont()->setBold(true)->setSize(13);
                        $cell33 = $row->nextCell();
                        $cell33->createTextRun('Mar')->getFont()->setBold(true)->setSize(13);
                        $cell43 = $row->nextCell();
                        $cell43->createTextRun('Apr')->getFont()->setBold(true)->setSize(13);
                        $cell53 = $row->nextCell();
                        $cell53->createTextRun('Mei')->getFont()->setBold(true)->setSize(13);
                        $cell63 = $row->nextCell();
                        $cell63->createTextRun('Jun')->getFont()->setBold(true)->setSize(13);
                        $cell73 = $row->nextCell();
                        $cell73->createTextRun('Jul')->getFont()->setBold(true)->setSize(13);
                        $cell83 = $row->nextCell();
                        $cell83->createTextRun('Agu')->getFont()->setBold(true)->setSize(13);
                        $cell93 = $row->nextCell();
                        $cell93->createTextRun('Sept.')->getFont()->setBold(true)->setSize(13);
                        $cell103 = $row->nextCell();
                        $cell103->createTextRun('Okt')->getFont()->setBold(true)->setSize(13);
                        $cell113 = $row->nextCell();
                        $cell113->createTextRun('Nov')->getFont()->setBold(true)->setSize(13);
                        $cell123 = $row->nextCell();
                        $cell123->createTextRun('Des')->getFont()->setBold(true)->setSize(13);
                        $cell133 = $row->nextCell();
                        $cell133->createTextRun('Total')->getFont()->setBold(true)->setSize(13);
                    }elseif ( $j == 2 ){
                        $cell03 = $row->nextCell();
                        $cell03->createTextRun('Budget');
                        $cell13 = $row->nextCell();
                        $cell13->createTextRun(number_format(($januari = $arrayBulananCashOut["januari"] + $arrayCarryOverCashOut["januari"])/1000000),2)->getFont()->setBold(true)->setSize(13);
                        $cell23 = $row->nextCell();
                        $cell23->createTextRun(number_format(($februari = $arrayBulananCashOut["februari"] + $arrayCarryOverCashOut["februari"])/1000000),2)->getFont()->setBold(true)->setSize(13);
                        $cell33 = $row->nextCell();
                        $cell33->createTextRun(number_format(($maret = $arrayBulananCashOut["maret"] + $arrayCarryOverCashOut["maret"])/1000000),2)->getFont()->setBold(true)->setSize(13);
                        $cell43 = $row->nextCell();
                        $cell43->createTextRun(number_format(($april = $arrayBulananCashOut["april"] + $arrayCarryOverCashOut["april"])/1000000),2)->getFont()->setBold(true)->setSize(13);
                        $cell53 = $row->nextCell();
                        $cell53->createTextRun(number_format(($mei = $arrayBulananCashOut["mei"] + $arrayCarryOverCashOut["mei"])/1000000),2)->getFont()->setBold(true)->setSize(13);
                        $cell63 = $row->nextCell();
                        $cell63->createTextRun(number_format(($juni = $arrayBulananCashOut["juni"] + $arrayCarryOverCashOut["juni"])/1000000),2)->getFont()->setBold(true)->setSize(13);
                        $cell73 = $row->nextCell();
                        $cell73->createTextRun(number_format(($juli = $arrayBulananCashOut["juli"] + $arrayCarryOverCashOut["juli"])/1000000),2)->getFont()->setBold(true)->setSize(13);
                        $cell83 = $row->nextCell();
                        $cell83->createTextRun(number_format(($agustus = $arrayBulananCashOut["agustus"] + $arrayCarryOverCashOut["agustus"])/1000000),2)->getFont()->setBold(true)->setSize(13);
                        $cell93 = $row->nextCell();
                        $cell93->createTextRun(number_format(($september = $arrayBulananCashOut["september"] + $arrayCarryOverCashOut["september"])/1000000),2)->getFont()->setBold(true)->setSize(13);
                        $cell103 = $row->nextCell();
                        $cell103->createTextRun(number_format(($oktober = $arrayBulananCashOut["oktober"] + $arrayCarryOverCashOut["oktober"])/1000000),2)->getFont()->setBold(true)->setSize(13);
                        $cell113 = $row->nextCell();
                        $cell113->createTextRun(number_format(($november = $arrayBulananCashOut["november"] + $arrayCarryOverCashOut["november"])/1000000),2)->getFont()->setBold(true)->setSize(13);
                        $cell123 = $row->nextCell();
                        $cell123->createTextRun(number_format(($desember = $arrayBulananCashOut["desember"] + $arrayCarryOverCashOut["desember"])/1000000),2)->getFont()->setBold(true)->setSize(13);
                        $cell133 = $row->nextCell();
                        $cell133 = $cell13->createTextRun(number_format(($desember)/1000000),2)->getFont()->setBold(true)->setSize(13);
                    }elseif ( $j == 3 ){
                        $cell03 = $row->nextCell();
                        $cell03->createTextRun('Kumulatif Budget');
                        $cell13 = $row->nextCell();
                        $cell13->createTextRun(number_format(( $januari = $arrayBulananCashOut["januari"] + $arrayCarryOverCashOut["januari"])/1000000),2)->getFont()->setBold(true)->setSize(13);;
                        $cell23 = $row->nextCell();
                        $cell23->createTextRun(number_format(( $februari =  $januari + $arrayBulananCashOut["februari"] + $arrayCarryOverCashOut["februari"])/1000000),2)->getFont()->setBold(true)->setSize(13);
                        $cell33 = $row->nextCell();
                        $cell33->createTextRun(number_format(( $maret = $februari + $arrayBulananCashOut["maret"] + $arrayCarryOverCashOut["maret"])/1000000),2)->getFont()->setBold(true)->setSize(13);
                        $cell43 = $row->nextCell();
                        $cell43->createTextRun(number_format(( $april = $maret + $arrayBulananCashOut["april"] + $arrayCarryOverCashOut["april"])/1000000),2)->getFont()->setBold(true)->setSize(13);
                        $cell53 = $row->nextCell();
                        $cell53->createTextRun(number_format(( $mei = $april + $arrayBulananCashOut["mei"] + $arrayCarryOverCashOut["mei"])/1000000),2)->getFont()->setBold(true)->setSize(13);
                        $cell63 = $row->nextCell();
                        $cell63->createTextRun(number_format(( $juni = $mei + $arrayBulananCashOut["juni"] + $arrayCarryOverCashOut["juni"])/1000000),2)->getFont()->setBold(true)->setSize(13);
                        $cell73 = $row->nextCell();
                        $cell73->createTextRun(number_format(( $juli = $juni + $arrayBulananCashOut["juli"] + $arrayCarryOverCashOut["juli"])/1000000),2)->getFont()->setBold(true)->setSize(13);
                        $cell83 = $row->nextCell();
                        $cell83->createTextRun(number_format(( $agustus = $juli + $arrayBulananCashOut["agustus"] + $arrayCarryOverCashOut["agustus"])/1000000),2)->getFont()->setBold(true)->setSize(13);
                        $cell93 = $row->nextCell();
                        $cell93->createTextRun(number_format(( $september = $agustus + $arrayBulananCashOut["september"] + $arrayCarryOverCashOut["september"])/1000000),2)->getFont()->setBold(true)->setSize(13);
                        $cell103 = $row->nextCell();
                        $cell103->createTextRun(number_format(( $oktober = $september + $arrayBulananCashOut["oktober"] + $arrayCarryOverCashOut["oktober"])/1000000),2)->getFont()->setBold(true)->setSize(13);
                        $cell113 = $row->nextCell();
                        $cell113->createTextRun(number_format(( $november = $oktober + $arrayBulananCashOut["november"] + $arrayCarryOverCashOut["november"])/1000000),2)->getFont()->setBold(true)->setSize(13);
                        $cell123 = $row->nextCell();
                        $cell123->createTextRun(number_format(( $desember = $november + $arrayBulananCashOut["desember"] + $arrayCarryOverCashOut["desember"])/1000000),2)->getFont()->setBold(true)->setSize(13);
                        $cell133 = $row->nextCell();
                        $cell133->createTextRun(number_format(($desember)/1000000),2)->getFont()->setBold(true)->setSize(13);
                                
                    }else if ( $j == 4 ){
                        $cell03 = $row->nextCell();
                        $cell03->createTextRun('Realisasi');
                        $cell13 = $row->nextCell();
                        $cell13->createTextRun(number_format(($januari = $project_devcost_realisasi["01"])/1000000),2)->getFont()->setBold(true)->setSize(13);;
                        $cell23 = $row->nextCell();
                        $cell23->createTextRun(number_format(($februari = $project_devcost_realisasi["02"])/1000000),2)->getFont()->setBold(true)->setSize(13);
                        $cell33 = $row->nextCell();
                        $cell33->createTextRun(number_format(($maret = $project_devcost_realisasi["03"])/1000000),2)->getFont()->setBold(true)->setSize(13);
                        $cell43 = $row->nextCell();
                        $cell43->createTextRun(number_format(($april =  $project_devcost_realisasi["04"])/1000000),2)->getFont()->setBold(true)->setSize(13);
                        $cell53 = $row->nextCell();
                        $cell53->createTextRun(number_format(($mei = $project_devcost_realisasi["05"])/1000000),2)->getFont()->setBold(true)->setSize(13);
                        $cell63 = $row->nextCell();
                        $cell63->createTextRun(number_format(($juni = $project_devcost_realisasi["06"])/1000000),2)->getFont()->setBold(true)->setSize(13);
                        $cell73 = $row->nextCell();
                        $cell73->createTextRun(number_format(($juli = $project_devcost_realisasi["07"])/1000000),2)->getFont()->setBold(true)->setSize(13);
                        $cell83 = $row->nextCell();
                        $cell83->createTextRun(number_format(($agustus = $project_devcost_realisasi["08"])/1000000),2)->getFont()->setBold(true)->setSize(13);
                        $cell93 = $row->nextCell();
                        $cell93->createTextRun(number_format(($september = $project_devcost_realisasi["09"])/1000000),2)->getFont()->setBold(true)->setSize(13);
                        $cell103 = $row->nextCell();
                        $cell103->createTextRun(number_format(($oktober = $project_devcost_realisasi["10"])/1000000),2)->getFont()->setBold(true)->setSize(13);
                        $cell113 = $row->nextCell();
                        $cell113->createTextRun(number_format(($november = $project_devcost_realisasi["11"])/1000000),2)->getFont()->setBold(true)->setSize(13);
                        $cell123 = $row->nextCell();
                        $cell123->createTextRun(number_format(($desember = $project_devcost_realisasi["12"])/1000000),2)->getFont()->setBold(true)->setSize(13);
                        $cell133 = $row->nextCell();
                        $cell133->createTextRun(number_format(($desember)/1000000),2)->getFont()->setBold(true)->setSize(13);
                    }else if ( $j == 5 ){
                        $cell03 = $row->nextCell();
                        $cell03->createTextRun('Kumulatif Realisasi');
                        $cell13 = $row->nextCell();
                        $cell13->createTextRun(number_format(( $januari = $project_devcost_realisasi["01"])/1000000),2)->getFont()->setBold(true)->setSize(13);;
                        $cell23 = $row->nextCell();
                        $cell23->createTextRun(number_format(( $februari =  $januari + $project_devcost_realisasi["02"])/1000000),2)->getFont()->setBold(true)->setSize(13);
                        $cell33 = $row->nextCell();
                        $cell33->createTextRun(number_format(( $maret = $februari + $project_devcost_realisasi["03"])/1000000),2)->getFont()->setBold(true)->setSize(13);
                        $cell43 = $row->nextCell();
                        $cell43->createTextRun(number_format(( $april = $maret + $project_devcost_realisasi["04"])/1000000),2)->getFont()->setBold(true)->setSize(13);
                        $cell53 = $row->nextCell();
                        $cell53->createTextRun(number_format(( $mei = $april + $project_devcost_realisasi["05"])/1000000),2)->getFont()->setBold(true)->setSize(13);
                        $cell63 = $row->nextCell();
                        $cell63->createTextRun(number_format(( $juni = $mei + $project_devcost_realisasi["06"])/1000000),2)->getFont()->setBold(true)->setSize(13);
                        $cell73 = $row->nextCell();
                        $cell73->createTextRun(number_format(( $juli = $juni + $project_devcost_realisasi["07"] )/1000000),2)->getFont()->setBold(true)->setSize(13);
                        $cell83 = $row->nextCell();
                        $cell83->createTextRun(number_format(( $agustus = $juli + $project_devcost_realisasi["08"])/1000000),2)->getFont()->setBold(true)->setSize(13);
                        $cell93 = $row->nextCell();
                        $cell93->createTextRun(number_format(( $september = $agustus + $project_devcost_realisasi["09"])/1000000),2)->getFont()->setBold(true)->setSize(13);
                        $cell103 = $row->nextCell();
                        $cell103->createTextRun(number_format(( $oktober = $september + $project_devcost_realisasi["10"])/1000000),2)->getFont()->setBold(true)->setSize(13);
                        $cell113 = $row->nextCell();
                        $cell113->createTextRun(number_format(( $november = $oktober + $project_devcost_realisasi["11"])/1000000),2)->getFont()->setBold(true)->setSize(13);
                        $cell123 = $row->nextCell();
                        $cell123->createTextRun(number_format(( $desember = $november + $project_devcost_realisasi["12"])/1000000),2)->getFont()->setBold(true)->setSize(13);
                        $cell133 = $row->nextCell();
                        $cell133->createTextRun(number_format(($desember)/1000000),2)->getFont()->setBold(true)->setSize(13);
                    }
                }  
            }elseif ( $i == 4 ){
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
                $textRun = $shape->createTextRun("CONCOST ");
                $textRun->getFont()->setBold(true);
                $textRun->getFont()->setSize(18);
                $textRun->getFont()->setColor($colorBlack);
                $shape->createBreak();
            }elseif ( $i == 5 ){
                $tahun_sebelumnya = date("Y") - 1 ;
                $shape = $slide->createRichTextShape();
                $shape->setHeight(200);
                $shape->setWidth(600);
                $shape->setOffsetX(450);
                $shape->setOffsetY(30);
                $shape->getActiveParagraph()->getAlignment()->setHorizontal( Alignment::HORIZONTAL_LEFT );
                $textRun = $shape->createTextRun("| RINCIAN CASH OUT ".date("Y"));
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
                $textRun = $shape->createTextRun("DEVELOPMENT COST ");
                $textRun->getFont()->setBold(true);
                $textRun->getFont()->setSize(18);
                $textRun->getFont()->setColor($colorBlack);
                $shape->createBreak();

                $array_pekerjaan = array();
                foreach ($project->budget_tahunans as $key => $value) {
                    if ( $value->approval != "" ){
                        if ( $value->approval->approval_action_id == 6 ){
                            foreach ($value->details as $key2 => $value2) {
                                if ( ! ( isset($array_pekerjaan[$value2->itempekerjaans->parent->id] ))){
                                    $array_pekerjaan[$value2->itempekerjaans->parent->id] = array(
                                        "nilai" => $value2->volume * $value2->nilai,
                                        "pekerjaan" => $value2->itempekerjaans->parent->name,
                                        "coa" => $value2->itempekerjaans->parent->code
                                    );
                                }else{
                                    $array_pekerjaan[$value2->itempekerjaans->parent->id] = array(
                                        "nilai" => ( $value2->volume * $value2->nilai ) + $array_pekerjaan[$value2->itempekerjaans->parent->id]['nilai'],
                                        "pekerjaan" => $value2->itempekerjaans->parent->name,
                                        "coa" => $value2->itempekerjaans->parent->code
                                    );
                                }
                            }
                        }
                    }
                }

                $shape = $slide->createTableShape(8);
                $shape->setHeight(200);
                $shape->setWidth(900);
                $shape->setOffsetX(20);
                $shape->setOffsetY(350);

                $row = $shape->createRow();
                $cell135 = $row->nextCell();
                $cell135->createTextRun('')->getFont()->setBold(true)->setSize(13);
                $cell145 = $row->nextCell();
                $cell145->createTextRun('')->getFont()->setBold(true)->setSize(13);
                $cell155 = $row->nextCell();
                $cell155->createTextRun("")->getFont()->setBold(true)->setSize(13);
                $cell165 = $row->nextCell();
                $cell165->createTextRun("")->getFont()->setBold(true)->setSize(13);
                $cell175 = $row->nextCell();
                $cell175->createTextRun("")->getFont()->setBold(true)->setSize(13);            
                $cell185 = $row->nextCell();
                $cell185->createTextRun("")->getFont()->setBold(true)->setSize(13);  
                $cell195 = $row->nextCell();
                $cell195->createTextRun("")->getFont()->setBold(true)->setSize(13);
                $cell205 = $row->nextCell();
                $cell205->createTextRun("")->getFont()->setBold(true)->setSize(13);

                $row = $shape->createRow();
                $row->getFill()->setFillType(Fill::FILL_SOLID)->setStartColor(new Color('C00000'))->setEndColor(new Color('C00000'));
                $cell05 = $row->nextCell();
                $cell05->createTextRun('No.')->getFont()->setBold(true)->setSize(13);
                $cell05->setRowSpan(2);
                $cell15 = $row->nextCell();
                $cell15->createTextRun('Item Pekerjaan')->getFont()->setBold(true)->setSize(13);
                $cell15->setRowSpan(2);
                $cell25 = $row->nextCell();
                $cell25->createTextRun(date("Y") - 1 )->getFont()->setBold(true)->setSize(13);
                $cell35 = $row->nextCell();
                $cell35->createTextRun(date("Y"))->getFont()->setBold(true)->setSize(13);
                $cell35->setColspan(4);
                $cell45 = $row->nextCell();
                $cell45->createTextRun(date("Y"))->getFont()->setBold(true)->setSize(13);

                $row = $shape->createRow();
                $cell55 = $row->nextCell();
                $cell55->createTextRun('')->getFont()->setBold(true)->setSize(13);
                $cell65 = $row->nextCell();
                $cell65->createTextRun('')->getFont()->setBold(true)->setSize(13);
                $cell75 = $row->nextCell();
                $cell75->createTextRun("Realisasi")->getFont()->setBold(true)->setSize(13);
                $cell85 = $row->nextCell();
                $cell85->createTextRun("Target")->getFont()->setBold(true)->setSize(13);
                $cell95 = $row->nextCell();
                $cell95->createTextRun("Realisasi")->getFont()->setBold(true)->setSize(13);            
                $cell105 = $row->nextCell();
                $cell105->createTextRun("P(%)")->getFont()->setBold(true)->setSize(13);  
                $cell115 = $row->nextCell();
                $cell115->createTextRun("G(%)")->getFont()->setBold(true)->setSize(13);
                $cell125 = $row->nextCell();
                $cell125->createTextRun("Target")->getFont()->setBold(true)->setSize(13);

                $array_pekerjaan = array_sort($array_pekerjaan,'nilai',SORT_DESC,SORT_NUMERIC );
                $array_pekerjaan1 = array_reverse($array_pekerjaan);
                $start = 1;
                
                foreach ($array_pekerjaan1 as $key2 => $value2) {  
                    if ( $start < 10 ){
                        $nilai = 0;                  
                        $nilai_sebelumnya = 0;
                        if ( $value2['nilai'] > 0 ){
                            foreach ($project->voucher as $key3 => $value3) {
                                if ( $value3->date->format("Y") == $tahun_sebelumnya ){
                                    if (  $value3->bap->spk->itempekerjaan->parent != "" ){
                                        if ( $value3->bap->spk->itempekerjaan->parent->code == $value2['coa']){
                                            $nilai_sebelumnya = $nilai_sebelumnya + $value3->nilai;
                                        }
                                    }else{
                                        if ( $value3->bap->spk->itempekerjaan->code == $value2['coa']){
                                            $nilai_sebelumnya = $nilai_sebelumnya + $value2->nilai;
                                        }
                                    }
                                }elseif($value3->date->format("Y") == date("Y")){
                                    if (  $value3->bap->spk->itempekerjaan->parent != "" ){
                                        if ( $value3->bap->spk->itempekerjaan->parent->code == $value2['coa']){
                                            $nilai = $nilai + $value3->nilai;
                                        }
                                    }else{
                                        //echo $value3->bap->spk->itempekerjaan->code."<>".$value2['coa'];
                                        if ( $value3->bap->spk->itempekerjaan->code == $value2['coa']){
                                            $nilai = $nilai + $value3->nilai;
                                        }
                                    }
                                }
                            }

                            if ( $nilai > 0 ){
                                $p = ($nilai / $value2['nilai']) * 100;
                            }else{
                                $p = 0;
                            }

                            if ( $nilai_sebelumnya > 0 ){
                                $g = (( $nilai - $nilai_sebelumnya )/ $nilai_sebelumnya ) * 100;
                            }else{
                                $g = 0;
                            }

                            //echo $nilai;


                            $row = $shape->createRow();
                            $cell135 = $row->nextCell();
                            $cell135->createTextRun($start)->getFont()->setBold(true)->setSize(11);
                            $cell145 = $row->nextCell();
                            $cell145->createTextRun($value2['pekerjaan'])->getFont()->setBold(true)->setSize(11);
                            $cell155 = $row->nextCell();
                            $cell155->createTextRun(number_format(( $nilai_sebelumnya / 1000000),2))->getFont()->setBold(true)->setSize(11);
                            $cell165 = $row->nextCell();
                            $cell165->createTextRun(number_format(($value2['nilai'] / 1000000) ,2))->getFont()->setBold(true)->setSize(11);
                            $cell175 = $row->nextCell();
                            $cell175->createTextRun(number_format(($nilai / 1000000),2))->getFont()->setBold(true)->setSize(11);            
                            $cell185 = $row->nextCell();
                            $cell185->createTextRun(number_format($p,2)."%")->getFont()->setBold(true)->setSize(11);  
                            $cell195 = $row->nextCell();
                            $cell195->createTextRun(number_format($g,2)."%")->getFont()->setBold(true)->setSize(11);
                            $cell205 = $row->nextCell();
                            $cell205->createTextRun("")->getFont()->setBold(true)->setSize(11);
                            $start++;
                        }
                    }
                }
            }elseif ( $i == 6){
                $tahun_sebelumnya = date("Y") - 1 ;
                $shape = $slide->createRichTextShape();
                $shape->setHeight(200);
                $shape->setWidth(600);
                $shape->setOffsetX(450);
                $shape->setOffsetY(30);
                $shape->getActiveParagraph()->getAlignment()->setHorizontal( Alignment::HORIZONTAL_LEFT );
                $textRun = $shape->createTextRun("| RINCIAN CASH OUT ".date("Y"));
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
                $textRun = $shape->createTextRun("CONSTRUCTION COST ");
                $textRun->getFont()->setBold(true);
                $textRun->getFont()->setSize(18);
                $textRun->getFont()->setColor($colorBlack);
                $shape->createBreak();

                $shape = $slide->createTableShape(8);
                $shape->setHeight(200);
                $shape->setWidth(900);
                $shape->setOffsetX(20);
                $shape->setOffsetY(350);

                $row = $shape->createRow();
                $cell216 = $row->nextCell();
                $cell216->createTextRun('')->getFont()->setBold(true)->setSize(13);
                $cell226 = $row->nextCell();
                $cell226->createTextRun('')->getFont()->setBold(true)->setSize(13);
                $cell236 = $row->nextCell();
                $cell236->createTextRun("")->getFont()->setBold(true)->setSize(13);
                $cell246 = $row->nextCell();
                $cell246->createTextRun("")->getFont()->setBold(true)->setSize(13);
                $cell256 = $row->nextCell();
                $cell256->createTextRun("")->getFont()->setBold(true)->setSize(13);            
                $cell266 = $row->nextCell();
                $cell266->createTextRun("")->getFont()->setBold(true)->setSize(13);  
                $cell276 = $row->nextCell();
                $cell276->createTextRun("")->getFont()->setBold(true)->setSize(13);
                $cell286 = $row->nextCell();
                $cell286->createTextRun("")->getFont()->setBold(true)->setSize(13);

                $row = $shape->createRow();
                $row->getFill()->setFillType(Fill::FILL_SOLID)->setStartColor(new Color('C00000'))->setEndColor(new Color('C00000'));
                $cell06 = $row->nextCell();
                $cell06->createTextRun('No.')->getFont()->setBold(true)->setSize(13);
                $cell06->setRowSpan(2);
                $cell16 = $row->nextCell();
                $cell16->createTextRun('Tipe')->getFont()->setBold(true)->setSize(13);
                $cell16->setRowSpan(2);
                $cell26 = $row->nextCell();
                $cell26->createTextRun(date("Y") - 1 )->getFont()->setBold(true)->setSize(13);
                $cell36 = $row->nextCell();
                $cell36->createTextRun(date("Y"))->getFont()->setBold(true)->setSize(13);
                $cell36->setColspan(4);
                $cell46 = $row->nextCell();
                $cell46->createTextRun(date("Y"))->getFont()->setBold(true)->setSize(13);  

                $row = $shape->createRow();
                $cell56 = $row->nextCell();
                $cell56->createTextRun('')->getFont()->setBold(true)->setSize(13);
                $cell66 = $row->nextCell();
                $cell66->createTextRun('')->getFont()->setBold(true)->setSize(13);
                $cell76 = $row->nextCell();
                $cell76->createTextRun("Realisasi")->getFont()->setBold(true)->setSize(13);
                $cell86 = $row->nextCell();
                $cell86->createTextRun("Target")->getFont()->setBold(true)->setSize(13);
                $cell96 = $row->nextCell();
                $cell96->createTextRun("Realisasi")->getFont()->setBold(true)->setSize(13);            
                $cell106 = $row->nextCell();
                $cell106->createTextRun("P(%)")->getFont()->setBold(true)->setSize(13);  
                $cell116 = $row->nextCell();
                $cell116->createTextRun("G(%)")->getFont()->setBold(true)->setSize(13);
                $cell126 = $row->nextCell();
                $cell126->createTextRun("Target")->getFont()->setBold(true)->setSize(13);
                $start = 1;
                foreach ($project->unittype as $key => $value) {  
                    $nilai_realisasi = 0;
                    $nilai_target = 0;
                    $nilai_realisasi_now = 0;
                    $budget_concost = 0;
                    $nilai_target_2 = 0;
                    $budget_concost_2 = 0;

                    foreach ( $project->spks as $key2 => $value2 ){
                        if ( $value2->date->format("Y") == $tahun_sebelumnya ){
                            
                            if ( $value2->itempekerjaan->group_cost == 2) {
                        
                                foreach ($value2->details as $key3 => $value3) {
                                    if ( $value3->unit != "" ){
                                        if ( $value3->unit->type == $value->id ){
                                            foreach ($value2->baps as $key6 => $value6) {
                                                foreach ($value6->vouchers as $key7 => $value7) {
                                                    if ( $value7->pencairan_date != NULL ){
                                                        if ( $value7->pencairan_date->format("Y") == $tahun_sebelumnya ){
                                                            $nilai_realisasi = $nilai_realisasi + $value7->nilai;
                                                        }
                                                    }
                                                }
                                            }                                        
                                        }
                                    }
                                }
                            }

                        }elseif($value2->date->format("Y") == date("Y")){
                            if ( $value2->itempekerjaan->group_cost == 2) {
                                foreach ($value2->details as $key3 => $value3) {
                                    if ( $value3->unit->type == $value->id ){
                                        $nilai_realisasi_now = $nilai_realisasi_now + $value2->nilai;
                                    }
                                }
                            }
                        }
                    }       

                    foreach ($project->budget_tahunans as $key3 => $value3) {
                        if ( $value3->approval != "" ){
                            if ( $value3->approval->approval_action_id == 6){
                                if ( $value3->budget->kawasan != "" ){
                                    foreach ($value3->details as $key4 => $value4) {
                                        if ( $value4->itempekerjaans->group_cost == 2 ){
                                            if ( $value4->itempekerjaans->code == "100.00"){
                                                $budget_concost = $value4->nilai;
                                            }

                                        }
                                    }

                                    foreach ($value3->budget_unit as $key9 => $value9) {
                                        if ( $value9->unit_type_id == $value->id ){
                                            $nilai_target = $budget_concost * $value9->volume;
                                        }
                                    }
                               }
                            }elseif( $value3->approval->approval_action_id == 1 ){
                                if ( $value3->budget->kawasan != "" ){
                                    foreach ($value3->details as $key4 => $value4) {
                                        if ( $value4->itempekerjaans->group_cost == 2 ){
                                            if ( $value4->itempekerjaans->code == "100.00"){
                                                $budget_concost_2 = $value4->nilai;
                                            }

                                        }
                                    }

                                    foreach ($value3->budget_unit as $key9 => $value9) {
                                        if ( $value9->unit_type_id == $value->id ){
                                            $nilai_target_2 = $budget_concost_2 * $value9->volume;
                                        }
                                    }
                               }
                            }
                        }                        
                    };

                    if ( $nilai_target > 0 ){
                        $p = ( $nilai_realisasi / $nilai_target ) * 100;
                    }else{
                        $p = 0;
                    }

                    if ( $nilai_realisasi > 0 ){
                        $g = (( $nilai_realisasi_now - $nilai_realisasi ) / $nilai_realisasi) * 100 ;
                    }else{
                        $g = 0;
                    }

                    $row = $shape->createRow();
                    $cell136 = $row->nextCell();
                    $cell136->createTextRun($start)->getFont()->setBold(true)->setSize(13);
                    $cell146 = $row->nextCell();
                    $cell146->createTextRun($value->name)->getFont()->setBold(true)->setSize(13);
                    $cell156 = $row->nextCell();
                    $cell156->createTextRun(number_format(($nilai_realisasi /1000000),2))->getFont()->setBold(true)->setSize(13);
                    $cell166 = $row->nextCell();
                    $cell166->createTextRun(number_format(($nilai_target / 1000000),2))->getFont()->setBold(true)->setSize(13);
                    $cell176 = $row->nextCell();
                    $cell176->createTextRun(number_format(($nilai_realisasi_now / 1000000),2))->getFont()->setBold(true)->setSize(13);            
                    $cell186 = $row->nextCell();
                    $cell186->createTextRun(number_format(($p),2)."%")->getFont()->setBold(true)->setSize(13);  
                    $cell196 = $row->nextCell();
                    $cell196->createTextRun(number_format(($g),2)."%")->getFont()->setBold(true)->setSize(13);
                    $cell206= $row->nextCell();
                    $cell206->createTextRun(number_format(($nilai_target_2 / 1000000),2))->getFont()->setBold(true)->setSize(13);    
                    $start++;                
                }
            }elseif ( $i == 7){
                $tahun_sebelumnya = date("Y") - 1 ;
                $shape = $slide->createRichTextShape();
                $shape->setHeight(200);
                $shape->setWidth(600);
                $shape->setOffsetX(450);
                $shape->setOffsetY(30);
                $shape->getActiveParagraph()->getAlignment()->setHorizontal( Alignment::HORIZONTAL_LEFT );
                $textRun = $shape->createTextRun("| PEMBANGUNAN RUMAH & RUKO ".date("Y"));
                $textRun->getFont()->setBold(true);
                $textRun->getFont()->setSize(20);
                $textRun->getFont()->setColor($colorBlack);
                $shape->createBreak();

                $shape = $slide->createTableShape(8);
                $shape->setHeight(200);
                $shape->setWidth(900);
                $shape->setOffsetX(20);
                $shape->setOffsetY(350);

                $row = $shape->createRow();
                $cell217 = $row->nextCell();
                $cell217->createTextRun('')->getFont()->setBold(true)->setSize(13);
                $cell227 = $row->nextCell();
                $cell227->createTextRun('')->getFont()->setBold(true)->setSize(13);
                $cell237 = $row->nextCell();
                $cell237->createTextRun("")->getFont()->setBold(true)->setSize(13);
                $cell247 = $row->nextCell();
                $cell247->createTextRun("")->getFont()->setBold(true)->setSize(13);
                $cell257 = $row->nextCell();
                $cell257->createTextRun("")->getFont()->setBold(true)->setSize(13);            
                $cell267 = $row->nextCell();
                $cell267->createTextRun("")->getFont()->setBold(true)->setSize(13);  
                $cell277 = $row->nextCell();
                $cell277->createTextRun("")->getFont()->setBold(true)->setSize(13);
                $cell287 = $row->nextCell();
                $cell287->createTextRun("")->getFont()->setBold(true)->setSize(13);

                $row = $shape->createRow();
                $row->getFill()->setFillType(Fill::FILL_SOLID)->setStartColor(new Color('C00000'))->setEndColor(new Color('C00000'));
                $cell07 = $row->nextCell();
                $cell07->createTextRun('No.')->getFont()->setBold(true)->setSize(13);
                $cell07->setRowSpan(2);
                $cell17 = $row->nextCell();
                $cell17->createTextRun('Tipe')->getFont()->setBold(true)->setSize(13);
                $cell17->setRowSpan(2);
                $cell27 = $row->nextCell();
                $cell27->createTextRun(date("Y") - 1 )->getFont()->setBold(true)->setSize(13);
                $cell37 = $row->nextCell();
                $cell37->createTextRun(date("Y"))->getFont()->setBold(true)->setSize(13);
                $cell37->setColspan(4);
                $cell47 = $row->nextCell();
                $cell47->createTextRun(date("Y"))->getFont()->setBold(true)->setSize(13);  

                $row = $shape->createRow();
                $cell57 = $row->nextCell();
                $cell57->createTextRun('')->getFont()->setBold(true)->setSize(13);
                $cell67 = $row->nextCell();
                $cell67->createTextRun('')->getFont()->setBold(true)->setSize(13);
                $cell77 = $row->nextCell();
                $cell77->createTextRun("Realisasi")->getFont()->setBold(true)->setSize(13);
                $cell87 = $row->nextCell();
                $cell87->createTextRun("Target")->getFont()->setBold(true)->setSize(13);
                $cell97 = $row->nextCell();
                $cell97->createTextRun("Realisasi")->getFont()->setBold(true)->setSize(13);            
                $cell107 = $row->nextCell();
                $cell107->createTextRun("P(%)")->getFont()->setBold(true)->setSize(13);  
                $cell117 = $row->nextCell();
                $cell117->createTextRun("G(%)")->getFont()->setBold(true)->setSize(13);
                $cell127 = $row->nextCell();
                $cell127->createTextRun("Target")->getFont()->setBold(true)->setSize(13);

                $start = 0;
                foreach ($project->unittype as $key => $value) {
                    
                    $realisasi_unit = 0;
                    $target_unit = 0;
                    $realisasi_unit_2 = 0;
                    $target_unit_2 = 0;

                    foreach ($project->spks as $key2 => $value2) {
                        if ( $value2->itempekerjaan->group_cost == 2 ){
                            if ( $value2->date->format("Y") == $tahun_sebelumnya ){                                
                                foreach ($value2->details as $key3 => $value3) {
                                    if ( $value2->unit->type == $value->id ){
                                        $realisasi_unit = $realisasi_unit + 1;
                                    }
                                }
                            }elseif($value2->date->format("Y") == date("Y")) {
                                foreach ($value2->details as $key4 => $value4) {
                                    if ( $value2->unit->type == $value->id ){
                                        $realisasi_unit_2 = $realisasi_unit_2 + 1;
                                    }
                                }
                            }
                        }
                    }

                    foreach ($project->budget_tahunans as $key5 => $value5) {
                        if ( $value5->approval != "" ){
                            if ( $value5->approval->approval_action_id == 6){
                                foreach ($value5->budget_unit  as $key6 => $value6) {
                                    if ( $value6->unit_type_id == $value->id ){
                                        $target_unit = $target_unit + $value6->total_unit;
                                    }
                                }
                            } elseif( $value5->approval->approval_action_id == 1 ) {
                                foreach ($value5->budget_unit  as $key6 => $value6) {
                                    if ( $value6->unit_type_id == $value->id ){
                                        $target_unit_2 = $target_unit_2 + $value6->total_unit;
                                    }
                                }
                            }
                        }
                    }

                    if ( $nilai_target > 0 ){
                        $p = ( $realisasi_unit / $nilai_target ) * 100;
                    }else{
                        $p = 0;
                    }

                    if ( $realisasi_unit > 0 ){
                        $g = (( $realisasi_unit_2 - $realisasi_unit ) / $realisasi_unit ) * 100;
                    }else{
                        $g = 0;
                    }

                    $row = $shape->createRow();
                    $cell137 = $row->nextCell();
                    $cell137->createTextRun($start)->getFont()->setBold(true)->setSize(13);
                    $cell147 = $row->nextCell();
                    $cell147->createTextRun($value->name)->getFont()->setBold(true)->setSize(13);
                    $cell157 = $row->nextCell();
                    $cell157->createTextRun(number_format($realisasi_unit))->getFont()->setBold(true)->setSize(13);
                    $cell167 = $row->nextCell();
                    $cell167->createTextRun(number_format($target_unit))->getFont()->setBold(true)->setSize(13);
                    $cell177 = $row->nextCell();
                    $cell177->createTextRun(number_format($realisasi_unit_2))->getFont()->setBold(true)->setSize(13);            
                    $cell187 = $row->nextCell();
                    $cell187->createTextRun(number_format($p)."%")->getFont()->setBold(true)->setSize(13);  
                    $cell197 = $row->nextCell();
                    $cell197->createTextRun(number_format($g)."%")->getFont()->setBold(true)->setSize(13);
                    $cell207 = $row->nextCell();
                    $cell207->createTextRun(number_format($target_unit_2))->getFont()->setBold(true)->setSize(13);  
                    $start++;        
                }
            }elseif ( $i == 8 ){
                $tahun_sebelumnya = date("Y") - 1 ;
                $shape = $slide->createRichTextShape();
                $shape->setHeight(200);
                $shape->setWidth(600);
                $shape->setOffsetX(450);
                $shape->setOffsetY(30);
                $shape->getActiveParagraph()->getAlignment()->setHorizontal( Alignment::HORIZONTAL_LEFT );
                $textRun = $shape->createTextRun("| HUTANG BAYAR ".date("Y"));
                $textRun->getFont()->setBold(true);
                $textRun->getFont()->setSize(20);
                $textRun->getFont()->setColor($colorBlack);
                $shape->createBreak();

                $shape = $slide->createTableShape(8);
                $shape->setHeight(200);
                $shape->setWidth(900);
                $shape->setOffsetX(20);
                $shape->setOffsetY(350);

                $row8 = $shape->createRow();
                $cell08 = $row8->nextCell();
                $cell08->createTextRun('')->getFont()->setBold(true)->setSize(13);
                $cell18 = $row8->nextCell();
                $cell18->createTextRun('')->getFont()->setBold(true)->setSize(13);
                $cell28 = $row8->nextCell();
                $cell28->createTextRun('')->getFont()->setBold(true)->setSize(13);
                $cell38 = $row8->nextCell();
                $cell38->createTextRun('')->getFont()->setBold(true)->setSize(13);
                $cell48 = $row8->nextCell();
                $cell48->createTextRun('')->getFont()->setBold(true)->setSize(13);
                $cell58 = $row8->nextCell();
                $cell58->createTextRun('')->getFont()->setBold(true)->setSize(13);
                $cell68 = $row8->nextCell();
                $cell68->createTextRun('')->getFont()->setBold(true)->setSize(13);
                $cell78 = $row8->nextCell();
                $cell78->createTextRun('')->getFont()->setBold(true)->setSize(13);                

                $row8 = $shape->createRow();
                $cell88 = $row8->nextCell();
                $cell88->setRowSpan(2);
                $cell88->createTextRun('Tahun SPK')->getFont()->setBold(true)->setSize(13);
                $cell98 = $row8->nextCell();
                $cell98->setColSpan(3);
                $cell98->createTextRun('Prasarana')->getFont()->setBold(true)->setSize(13);
                $cell108 = $row8->nextCell();
                $cell108->createTextRun('Prasarana')->getFont()->setBold(true)->setSize(13);
                $cell118 = $row8->nextCell();
                $cell118->createTextRun('Prasarana')->getFont()->setBold(true)->setSize(13);
                $cell128 = $row8->nextCell();
                $cell128->setColSpan(3);
                $cell128->createTextRun('Bangunan Rumah,Ruko')->getFont()->setBold(true)->setSize(13);
                $cell138 = $row8->nextCell();
                $cell138->createTextRun('Bangunan Rumah,Ruko')->getFont()->setBold(true)->setSize(13);
                $cell148 = $row8->nextCell();
                $cell148->createTextRun('Bangunan Rumah,Ruko')->getFont()->setBold(true)->setSize(13);
                $cell158 = $row8->nextCell();
                $cell158->createTextRun('Total')->getFont()->setBold(true)->setSize(13);

                $row8 = $shape->createRow();
                $cell178 = $row8->nextCell();
                $cell178->createTextRun('')->getFont()->setBold(true)->setSize(13);
                $cell188 = $row8->nextCell();
                $cell188->createTextRun('Nilai Kontrak')->getFont()->setBold(true)->setSize(13);
                $cell198 = $row8->nextCell();
                $cell198->createTextRun('Terbayar')->getFont()->setBold(true)->setSize(13);
                $cell208 = $row8->nextCell();
                $cell208->createTextRun('Hutang Bayar')->getFont()->setBold(true)->setSize(13);
                $cell218 = $row8->nextCell();
                $cell218->createTextRun('Nilai Kontrak')->getFont()->setBold(true)->setSize(13);
                $cell228 = $row8->nextCell();
                $cell228->createTextRun('Terbayar')->getFont()->setBold(true)->setSize(13);
                $cell238 = $row8->nextCell();
                $cell238->createTextRun('Hutang Bayar')->getFont()->setBold(true)->setSize(13);
                $cell248 = $row8->nextCell();
                $cell248->createTextRun('Hutang Bayar')->getFont()->setBold(true)->setSize(13);

                foreach ($project->list_hutang_bayar_dev_cost as $key => $value) {
                    $row8 = $shape->createRow();
                    $cell258 = $row8->nextCell();
                    $cell258->createTextRun($value['tahun'])->getFont()->setBold(true)->setSize(13);
                    $cell268 = $row8->nextCell();
                    $cell268->createTextRun(number_format(($value['nilai_kontrak_dev_cost'] / 1000000),2))->getFont()->setBold(true)->setSize(13);
                    $cell278 = $row8->nextCell();
                    $cell278->createTextRun(number_format(($value['terbayar_dev_cost'] / 1000000),2))->getFont()->setBold(true)->setSize(13);
                    $cell288 = $row8->nextCell();
                    $cell288->createTextRun(number_format(($value['hutang_bayar_dev_cost'] / 1000000),2))->getFont()->setBold(true)->setSize(13);
                    $cell308 = $row8->nextCell();
                    $cell308->createTextRun(number_format(($value['nilai_kontrak_con_cost'] / 1000000),2))->getFont()->setBold(true)->setSize(13);
                    $cell318 = $row8->nextCell();
                    $cell318->createTextRun(number_format(($value['terbayar_con_cost'] / 1000000),2))->getFont()->setBold(true)->setSize(13);
                    $cell328 = $row8->nextCell();
                    $cell328->createTextRun(number_format(($value['hutang_bayar_con_cost'] / 1000000),2))->getFont()->setBold(true)->setSize(13);
                    $cell338 = $row8->nextCell();
                    $cell338->createTextRun(number_format(( ( $value['hutang_bayar_dev_cost'] + $value['hutang_bayar_con_cost']) / 1000000),2))->getFont()->setBold(true)->setSize(13);

                }      
            }elseif ( $i == 10 ){
                $tahun_sebelumnya = date("Y") - 1 ;
                $shape = $slide->createRichTextShape();
                $shape->setWidth(600);
                $shape->setOffsetX(450);
                $shape->setOffsetY(30);
                $shape->getActiveParagraph()->getAlignment()->setHorizontal( Alignment::HORIZONTAL_LEFT );
                $textRun = $shape->createTextRun("| HUTANG BANGUN ".date("Y"));
                $textRun->getFont()->setBold(true);
                $textRun->getFont()->setSize(20);
                $textRun->getFont()->setColor($colorBlack);
                $shape->createBreak();

                $shape = $slide->createTableShape(8);
                $shape->setWidth(900);
                $shape->setOffsetX(20);
                $shape->setOffsetY(250);

                $row8 = $shape->createRow();
                $cell010 = $row8->nextCell();
                $cell010->createTextRun('')->getFont()->setBold(true)->setSize(13);
                $cell110 = $row8->nextCell();
                $cell110->createTextRun('')->getFont()->setBold(true)->setSize(13);
                $cell210 = $row8->nextCell();
                $cell210->createTextRun('')->getFont()->setBold(true)->setSize(13);
                $cell310 = $row8->nextCell();
                $cell310->createTextRun('')->getFont()->setBold(true)->setSize(13);
                $cell410 = $row8->nextCell();
                $cell410->createTextRun('')->getFont()->setBold(true)->setSize(13);
                $cell510 = $row8->nextCell();
                $cell510->createTextRun('')->getFont()->setBold(true)->setSize(13);
                $cell610 = $row8->nextCell();
                $cell610->createTextRun('')->getFont()->setBold(true)->setSize(13);
                $cell710 = $row8->nextCell();
                $cell710->createTextRun('')->getFont()->setBold(true)->setSize(13);                

                $row8 = $shape->createRow();
                $cell810 = $row8->nextCell();
                $cell810->setRowSpan(2);
                $cell810->createTextRun('Tahun SPK')->getFont()->setBold(true)->setSize(13);
                $cell910 = $row8->nextCell();
                $cell910->setColSpan(2);
                $cell910->createTextRun('Prasarana')->getFont()->setBold(true)->setSize(13);
                $cell1010 = $row8->nextCell();
                $cell1010->createTextRun('Prasarana')->getFont()->setBold(true)->setSize(13);
                $cell1210 = $row8->nextCell();
                $cell1210->setColSpan(3);
                $cell1210->createTextRun('Bangunan Rumah,Ruko')->getFont()->setBold(true)->setSize(13);
                $cell1310 = $row8->nextCell();
                $cell1310->createTextRun('Bangunan Rumah,Ruko')->getFont()->setBold(true)->setSize(13);
                $cell1410 = $row8->nextCell();
                $cell1410->createTextRun('Bangunan Rumah,Ruko')->getFont()->setBold(true)->setSize(13);
                $cell1510 = $row8->nextCell();
                $cell1510->setColSpan(2);
                $cell1510->createTextRun('Total')->getFont()->setBold(true)->setSize(13);
               
                $row8 = $shape->createRow();
                $cell1710 = $row8->nextCell();
                $cell1710->createTextRun('')->getFont()->setBold(true)->setSize(13);
                $cell1810 = $row8->nextCell();
                $cell1810->createTextRun('Rp.')->getFont()->setBold(true)->setSize(13);
                $cell1910 = $row8->nextCell();
                $cell1910->createTextRun('LT(m2)')->getFont()->setBold(true)->setSize(13);
                $cell2110 = $row8->nextCell();
                $cell2110->createTextRun('Rp.')->getFont()->setBold(true)->setSize(13);
                $cell2210 = $row8->nextCell();
                $cell2210->createTextRun('unit')->getFont()->setBold(true)->setSize(13);
                $cell2310 = $row8->nextCell();
                $cell2310->createTextRun('LB(m2)')->getFont()->setBold(true)->setSize(13);
                $cell2410 = $row8->nextCell();
                $cell2410->createTextRun('Total Unit')->getFont()->setBold(true)->setSize(13);
                $cell2010 = $row8->nextCell();
                $cell2010->createTextRun('Rp')->getFont()->setBold(true)->setSize(13);

                $row8 = $shape->createRow();
                $cell3310 = $row8->nextCell();
                $cell3310->setColSpan(8);
                $cell3310->createTextRun('Hutang Bangun s/d end Year '.$tahun_sebelumnya)->getFont()->setBold(true)->setSize(13);

                $row8 = $shape->createRow();
                $cell2510 = $row8->nextCell();
                $cell2510->createTextRun(date("Y"))->getFont()->setBold(true)->setSize(13);
                $cell2610 = $row8->nextCell();
                $cell2610->createTextRun(number_format(($project->hutang_bayar / 1000000),2))->getFont()->setBold(true)->setSize(13);
                $cell2710 = $row8->nextCell();
                $cell2710->createTextRun(number_format($project->nilai_luas_hutang_bangun_dev_cost,2))->getFont()->setBold(true)->setSize(13);
                $cell2810 = $row8->nextCell();
                $cell2810->createTextRun(number_format(($project->hutang_bangun_concost / 1000000),2))->getFont()->setBold(true)->setSize(13);
                $cell2910 = $row8->nextCell();
                $cell2910->createTextRun($project->nilai_luas_pending_workorder["total"])->getFont()->setBold(true)->setSize(13);
                $cell3010 = $row8->nextCell();
                $cell3010->createTextRun($project->nilai_luas_pending_workorder["luas"])->getFont()->setBold(true)->setSize(13);
                $cell3110 = $row8->nextCell();
                $cell3110->createTextRun($project->nilai_luas_pending_workorder["total"])->getFont()->setBold(true)->setSize(13);
                $cell3210 = $row8->nextCell();
                $cell3210->createTextRun(number_format(($project->hutang_bangun_concost + $project->hutang_bayar) / 1000000),2)->getFont()->setBold(true)->setSize(13);


            }elseif ( $i == 11 ){
                $tahun_sebelumnya = date("Y") - 1 ;
                $shape = $slide->createRichTextShape();
                $shape->setWidth(600);
                $shape->setOffsetX(450);
                $shape->setOffsetY(30);
                $shape->getActiveParagraph()->getAlignment()->setHorizontal( Alignment::HORIZONTAL_LEFT );
                $textRun = $shape->createTextRun("| RINCIAN HUTANG BANGUN ".date("Y"));
                $textRun->getFont()->setBold(true);
                $textRun->getFont()->setSize(20);
                $textRun->getFont()->setColor($colorBlack);
                $shape->createBreak();

                $shape = $slide->createTableShape(2);
                $shape->setWidth(450);
                $shape->setOffsetX(20);
                $shape->setOffsetY(350);

                $row8 = $shape->createRow();
                $cell011 = $row8->nextCell();
                $cell011->setWidth(45);
                $cell011->createTextRun('')->getFont()->setBold(true)->setSize(13);
                $cell111 = $row8->nextCell();
                $cell111->createTextRun('')->getFont()->setBold(true)->setSize(13);

                $row8 = $shape->createRow();
                $cell411 = $row8->nextCell();
                $cell411->setWidth(45);
                $cell411->createTextRun('')->getFont()->setBold(true)->setSize(13);
                $cell511 = $row8->nextCell();
                $cell511->createTextRun('Prasarana <='. date("Y"))->getFont()->setBold(true)->setSize(13);


                $shape = $slide->createTableShape(3);
                $shape->setWidth(450);
                $shape->setOffsetX(500);
                $shape->setOffsetY(350);

                $row8 = $shape->createRow();
                $cell611 = $row8->nextCell();
                $cell611->createTextRun('')->getFont()->setBold(true)->setSize(13);
                $cell711 = $row8->nextCell();
                $cell711->createTextRun('')->getFont()->setBold(true)->setSize(13);

                $row8 = $shape->createRow();
                $cell811 = $row8->nextCell();
                $cell811->createTextRun('')->getFont()->setBold(true)->setSize(13);
                $cell911 = $row8->nextCell();
                $cell911->createTextRun('Bangunan ( Rumah + Ruko )')->getFont()->setBold(true)->setSize(13);

                foreach ($project->hutang_bangun_kawasan as $key11 => $value11) {
                    $row8 = $shape->createRow();
                    $cell811 = $row8->nextCell();
                    $cell811->createTextRun($key11 + 1 )->getFont()->setBold(true)->setSize(13);
                    $cell911 = $row8->nextCell();
                    $cell911->createTextRun($value11['name'] ." = [".$value11['terjual']." terjual dan ".$value11['stock']." stock ]")->getFont()->setBold(true)->setSize(13);
                }

            }elseif ( $i == 12 ){
                $shape = $slide->createRichTextShape();
                $shape->setHeight(200);
                $shape->setWidth(600);
                $shape->setOffsetX(450);
                $shape->setOffsetY(30);
                $shape->getActiveParagraph()->getAlignment()->setHorizontal( Alignment::HORIZONTAL_LEFT );
                $textRun = $shape->createTextRun("| RINCIAN HUTANG BANGUN");
                $textRun->getFont()->setBold(true);
                $textRun->getFont()->setSize(20);
                $textRun->getFont()->setColor($colorBlack);
                $shape->createBreak();

                $shape = $slide->createRichTextShape();
                $shape->setWidth(900);
                $shape->setOffsetX(150);
                $shape->setOffsetY(70);
                $shape->getActiveParagraph()->getAlignment()->setHorizontal( Alignment::HORIZONTAL_LEFT );
                $textRun = $shape->createTextRun("HUTANG BANGUN DEVELOPMENT COST SKALA KOTA 2018".date("Y"));
                $textRun->getFont()->setBold(true);
                $textRun->getFont()->setSize(20);
                $textRun->getFont()->setColor($colorBlack);
                $shape->createBreak();

                $shape = $slide->createTableShape(3);
                $shape->setWidth(900);
                $shape->setOffsetX(20);
                $shape->setOffsetY(250);

                $row8 = $shape->createRow();
                $cell112 = $row8->nextCell();
                $cell112->setWidth(45);
                $cell112->createTextRun('No.')->getFont()->setBold(true)->setSize(13);
                $cell212 = $row8->nextCell();
                $cell212->createTextRun('Items')->getFont()->setBold(true)->setSize(13);
                $cell312 = $row8->nextCell();
                $cell312->createTextRun('Biaya')->getFont()->setBold(true)->setSize(13);            

                $row8 = $shape->createRow();
                $cell712 = $row8->nextCell();
                $cell712->setWidth(45);
                $cell712->createTextRun('No.')->getFont()->setBold(true)->setSize(13);
                $cell812 = $row8->nextCell();
                $cell812->createTextRun('Items')->getFont()->setBold(true)->setSize(13);
                $cell912 = $row8->nextCell();
                $cell912->createTextRun('Biaya')->getFont()->setBold(true)->setSize(13);

                foreach ($project->budget_tahunans as $key12a => $value12b) {
                    if ( $value12b->tahun_anggaran == date("Y")){
                        if ( $value12b->budget->kawasan == "" ){
                            foreach ($value12b->details as $key12c => $value12c) {
                                if ( $value12c->nilai > 0 && $value12c->volume > 0 ){
                                    $row8 = $shape->createRow();
                                    $cell412 = $row8->nextCell();
                                    $cell412->setWidth(45);
                                    $cell412->createTextRun($key12c + 1 )->getFont()->setBold(true)->setSize(13);
                                    $cell512 = $row8->nextCell();
                                    $cell512->createTextRun($value12c->itempekerjaans->name)->getFont()->setBold(true)->setSize(13);
                                    $cell612 = $row8->nextCell();
                                    $cell612->createTextRun(number_format($value12c->nilai * $value12c->volume))->getFont()->setBold(true)->setSize(13);
                                }
                            }
                        }
                    }
                }

            }elseif ( $i == 13 ){
                $shape = $slide->createRichTextShape();
                $shape->setHeight(200);
                $shape->setWidth(600);
                $shape->setOffsetX(450);
                $shape->setOffsetY(30);
                $shape->getActiveParagraph()->getAlignment()->setHorizontal( Alignment::HORIZONTAL_LEFT );
                $textRun = $shape->createTextRun("| RINCIAN HUTANG BANGUN");
                $textRun->getFont()->setBold(true);
                $textRun->getFont()->setSize(20);
                $textRun->getFont()->setColor($colorBlack);
                $shape->createBreak();

                $shape = $slide->createRichTextShape();
                $shape->setWidth(900);
                $shape->setOffsetX(150);
                $shape->setOffsetY(70);
                $shape->getActiveParagraph()->getAlignment()->setHorizontal( Alignment::HORIZONTAL_LEFT );
                $textRun = $shape->createTextRun("HUTANG BANGUN DEVELOPMENT COST SKALA CLUSTER 2018".date("Y"));
                $textRun->getFont()->setBold(true);
                $textRun->getFont()->setSize(20);
                $textRun->getFont()->setColor($colorBlack);
                $shape->createBreak();

                $shape = $slide->createTableShape(3);
                $shape->setWidth(900);
                $shape->setOffsetX(20);
                $shape->setOffsetY(250);

                $row8 = $shape->createRow();
                $cell113 = $row8->nextCell();
                $cell113->setWidth(45);
                $cell113->createTextRun('No.')->getFont()->setBold(true)->setSize(13);
                $cell213 = $row8->nextCell();
                $cell213->createTextRun('Items')->getFont()->setBold(true)->setSize(13);
                $cell313 = $row8->nextCell();
                $cell313->createTextRun('Biaya')->getFont()->setBold(true)->setSize(13);            

                $row8 = $shape->createRow();
                $cell713 = $row8->nextCell();
                $cell713->setWidth(45);
                $cell713->createTextRun('No.')->getFont()->setBold(true)->setSize(13);
                $cell813 = $row8->nextCell();
                $cell813->createTextRun('Items')->getFont()->setBold(true)->setSize(13);
                $cell913 = $row8->nextCell();
                $cell913->createTextRun('Biaya')->getFont()->setBold(true)->setSize(13);

                foreach ($project->budget_tahunans as $key13a => $value13b) {
                    if ( $value13b->tahun_anggaran == date("Y")){
                        if ( $value12b->budget->kawasan != "" ){
                            foreach ($value13b->details as $key13c => $value13c) {
                                if ( $value13c->nilai > 0 && $value13c->volume > 0 ){
                                    $row8 = $shape->createRow();
                                    $cell413 = $row8->nextCell();
                                    $cell413->setWidth(45);
                                    $cell413->createTextRun($key13c + 1 )->getFont()->setBold(true)->setSize(13);
                                    $cell513 = $row8->nextCell();
                                    $cell513->createTextRun($value13c->itempekerjaans->name)->getFont()->setBold(true)->setSize(13);
                                    $cell613 = $row8->nextCell();
                                    $cell613->createTextRun(number_format($value13c->nilai * $value13c->volume))->getFont()->setBold(true)->setSize(13);
                                }
                            }
                        }
                    }
                }
            }elseif ( $i == 14 ){
                $tahun_sebelumnya = date("Y") - 1 ;
                $shape = $slide->createRichTextShape();
                $shape->setHeight(200);
                $shape->setWidth(600);
                $shape->setOffsetX(450);
                $shape->setOffsetY(30);
                $shape->getActiveParagraph()->getAlignment()->setHorizontal( Alignment::HORIZONTAL_LEFT );
                $textRun = $shape->createTextRun("| RINCIAN HUTANG BANGUN ".date("Y"));
                $textRun->getFont()->setBold(true);
                $textRun->getFont()->setSize(20);
                $textRun->getFont()->setColor($colorBlack);
                $shape->createBreak();

                $shape = $slide->createTableShape(11);
                $shape->setWidth(900);
                $shape->setOffsetX(20);
                $shape->setOffsetY(250);

                $row8 = $shape->createRow();
                $cell114 = $row8->nextCell();
                $cell114->setWidth(45);
                $cell114->createTextRun('Cluster/Blok')->getFont()->setBold(true)->setSize(13);
                $cell214 = $row8->nextCell();
                $cell214->createTextRun('Uraian')->getFont()->setBold(true)->setSize(13);
                $cell314 = $row8->nextCell();
                $cell314->createTextRun('Total 1 Cluster')->getFont()->setBold(true)->setSize(13);
                $cell414 = $row8->nextCell();
                $cell414->createTextRun('Total Per Tipe')->getFont()->setBold(true)->setSize(13);
                $cell514 = $row8->nextCell();
                $cell514->createTextRun('Total Bangun < '. date("Y"))->getFont()->setBold(true)->setSize(13);
                $cell614 = $row8->nextCell();
                $cell614->createTextRun('SPK 2017 semester 1')->getFont()->setBold(true)->setSize(13);
                $cell714 = $row8->nextCell();
                $cell714->createTextRun('SPK 2017 semester 1')->getFont()->setBold(true)->setSize(13);
                $cell814 = $row8->nextCell();
                $cell814->createTextRun('Total Bangun')->getFont()->setBold(true)->setSize(13);
                $cell1014 = $row8->nextCell();
                $cell1014->createTextRun('Hutang Bangun '.date("Y"))->getFont()->setBold(true)->setSize(13);
                $cell1114 = $row8->nextCell();
                $cell1114->createTextRun('Sisa belum bangun')->getFont()->setBold(true)->setSize(13);
                $cell1214 = $row8->nextCell();
                $cell1214->createTextRun('Unit Stock terbangun')->getFont()->setBold(true)->setSize(13);

                $row8 = $shape->createRow();
                $cell114 = $row8->nextCell();
                $cell114->setWidth(45);
                $cell114->createTextRun('Cluster/Blok')->getFont()->setBold(true)->setSize(13);
                $cell214 = $row8->nextCell();
                $cell214->createTextRun('Uraian')->getFont()->setBold(true)->setSize(13);
                $cell314 = $row8->nextCell();
                $cell314->createTextRun('Total 1 Cluster')->getFont()->setBold(true)->setSize(13);
                $cell414 = $row8->nextCell();
                $cell414->createTextRun('Total Per Tipe')->getFont()->setBold(true)->setSize(13);
                $cell514 = $row8->nextCell();
                $cell514->createTextRun('Total Bangun < '. date("Y"))->getFont()->setBold(true)->setSize(13);
                $cell614 = $row8->nextCell();
                $cell614->createTextRun('SPK 2017 semester 1')->getFont()->setBold(true)->setSize(13);
                $cell714 = $row8->nextCell();
                $cell714->createTextRun('SPK 2017 semester 1')->getFont()->setBold(true)->setSize(13);
                $cell814 = $row8->nextCell();
                $cell814->createTextRun('Total Bangun')->getFont()->setBold(true)->setSize(13);
                $cell1014 = $row8->nextCell();
                $cell1014->createTextRun('Hutang Bangun '.date("Y"))->getFont()->setBold(true)->setSize(13);
                $cell1114 = $row8->nextCell();
                $cell1114->createTextRun('Sisa belum bangun')->getFont()->setBold(true)->setSize(13);
                $cell1214 = $row8->nextCell();
                $cell1214->createTextRun('Unit Stock terbangun')->getFont()->setBold(true)->setSize(13);

                foreach ($project->kawasans as $key14a => $value14a) {
                    $row8 = $shape->createRow();
                    $cell1314 = $row8->nextCell();                    
                    $cell1314->setRowSpan($value14a->unit_type->count());
                    $cell1314->createTextRun($value14a->name)->getFont()->setBold(true)->setSize(13);

                    $row8 = $shape->createRow();
                    $cell100314 = $row8->nextCell();                    
                    $cell100314->setRowSpan($value14a->unit_type->count());
                    $cell100314->createTextRun($value14a->name)->getFont()->setBold(true)->setSize(13);
   
                    foreach ($value14a->unit_type as $key14b => $value14b) {
                        if ( $key14b == 0 ){
                            $cell1414 = $row8->nextCell();                    
                            $cell1414->createTextRun($value14b->name)->getFont()->setBold(true)->setSize(13);
                            
                            $cell1514 = $row8->nextCell();                    
                            $cell1514->setRowSpan($value14a->unit_type->count());
                            $cell1514->createTextRun($value14a->units->count())->getFont()->setBold(true)->setSize(13);

                            $cell1614 = $row8->nextCell();                    
                            $cell1614->createTextRun($value14b->unit->count())->getFont()->setBold(true)->setSize(13);
                            $total_terbangun_prev = 0;
                            $total_terbangun_now1 = 0;
                            $total_terbangun_now2 = 0;

                            foreach ($value14b->hpp_concost as $key14c => $value14c) {
                                if ( $value14c->created_at->format("Y") == $tahun_sebelumnya ){
                                    $total_terbangun_prev = $total_terbangun_prev + $value14c->total_terbangun;
                                }
                            }

                            foreach ($value14b->hpp_concost as $key14d => $value14c) {
                                if ( $value14c->created_at->format("Y") == date("Y") ){
                                    if ( $value14c->created_at->format("m") <= 6 ){
                                        $total_terbangun_now1 = $total_terbangun_now1 + $value14c->total_terbangun;
                                    }else{
                                        $total_terbangun_now2 = $total_terbangun_now2 + $value14c->total_terbangun;
                                    }
                                }
                            }

                            $cell1714 = $row8->nextCell();                    
                            $cell1714->createTextRun($total_terbangun_prev)->getFont()->setBold(true)->setSize(13);

                            $cell1814 = $row8->nextCell();                    
                            $cell1814->createTextRun($total_terbangun_now1)->getFont()->setBold(true)->setSize(13);

                            $cell1914 = $row8->nextCell();                    
                            $cell1914->createTextRun($total_terbangun_now2)->getFont()->setBold(true)->setSize(13);

                            $cell2014 = $row8->nextCell();     
                            $tot = $total_terbangun_prev + $total_terbangun_now1 + $total_terbangun_now2;    
                            $cell2014->createTextRun($tot)->getFont()->setBold(true)->setSize(13);

                            $cell2014 = $row8->nextCell();                    
                            $cell2014->createTextRun($value14b->pending_wo)->getFont()->setBold(true)->setSize(13);

                            $cell2114 = $row8->nextCell();                    
                            $cell2114->createTextRun($value14b->pending_wo - $tot)->getFont()->setBold(true)->setSize(13);

                            $cell2114 = $row8->nextCell();                    
                            $cell2114->createTextRun($value14b->unit_terbangun)->getFont()->setBold(true)->setSize(13);
                        }else{
                            $row8 = $shape->createRow();
                            $cell2214 = $row8->nextCell();                    
                            $cell2214->createTextRun($value14b->name)->getFont()->setBold(true)->setSize(13);

                            $cell2214 = $row8->nextCell();                    
                            $cell2214->createTextRun($value14b->name)->getFont()->setBold(true)->setSize(13);

                            $cell1514 = $row8->nextCell();                    
                            $cell1514->setRowSpan($value14a->unit_type->count());
                            $cell1514->createTextRun($value14a->units->count())->getFont()->setBold(true)->setSize(13);

                            $cell1614 = $row8->nextCell();                    
                            $cell1614->createTextRun($value14b->unit->count())->getFont()->setBold(true)->setSize(13);
                            $total_terbangun_prev = 0;
                            $total_terbangun_now1 = 0;
                            $total_terbangun_now2 = 0;

                            foreach ($value14b->hpp_concost as $key14c => $value14c) {
                                if ( $value14c->created_at->format("Y") == $tahun_sebelumnya ){
                                    $total_terbangun_prev = $total_terbangun_prev + $value14c->total_terbangun;
                                }
                            }

                            foreach ($value14b->hpp_concost as $key14d => $value14c) {
                                if ( $value14c->created_at->format("Y") == date("Y") ){
                                    if ( $value14c->created_at->format("m") <= 6 ){
                                        $total_terbangun_now1 = $total_terbangun_now1 + $value14c->total_terbangun;
                                    }else{
                                        $total_terbangun_now2 = $total_terbangun_now2 + $value14c->total_terbangun;
                                    }
                                }
                            }

                            $cell1714 = $row8->nextCell();                    
                            $cell1714->createTextRun($total_terbangun_prev)->getFont()->setBold(true)->setSize(13);

                            $cell1814 = $row8->nextCell();                    
                            $cell1814->createTextRun($total_terbangun_now1)->getFont()->setBold(true)->setSize(13);

                            $cell1914 = $row8->nextCell();                    
                            $cell1914->createTextRun($total_terbangun_now2)->getFont()->setBold(true)->setSize(13);

                            $cell2014 = $row8->nextCell();     
                            $tot = $total_terbangun_prev + $total_terbangun_now1 + $total_terbangun_now2;    
                            $cell2014->createTextRun($tot)->getFont()->setBold(true)->setSize(13);

                            $cell2014 = $row8->nextCell();                    
                            $cell2014->createTextRun($value14b->pending_wo)->getFont()->setBold(true)->setSize(13);

                            $cell2114 = $row8->nextCell();                    
                            $cell2114->createTextRun($value14b->pending_wo - $tot)->getFont()->setBold(true)->setSize(13);

                            $cell2114 = $row8->nextCell();                    
                            $cell2114->createTextRun($value14b->unit_terbangun)->getFont()->setBold(true)->setSize(13);
                        }
                    }                   

                }
            }elseif ( $i == 15 ){
                $tahun_sebelumnya = date("Y") - 1 ;
                $shape = $slide->createRichTextShape();
                $shape->setWidth(600);
                $shape->setOffsetX(450);
                $shape->setOffsetY(30);
                $shape->getActiveParagraph()->getAlignment()->setHorizontal( Alignment::HORIZONTAL_LEFT );
                $textRun = $shape->createTextRun("| STOCK UNIT BELUM TERBANGUN ".date("Y"));
                $textRun->getFont()->setBold(true);
                $textRun->getFont()->setSize(20);
                $textRun->getFont()->setColor($colorBlack);
                $shape->createBreak();

                $shape = $slide->createTableShape(8);
                $shape->setWidth(900);
                $shape->setOffsetX(20);
                $shape->setOffsetY(250);

                $row8 = $shape->createRow();
                $cell0115 = $row8->nextCell();
                $cell0115->createTextRun('')->getFont()->setBold(true)->setSize(13);
                $cell1115 = $row8->nextCell();
                $cell1115->createTextRun('')->getFont()->setBold(true)->setSize(13);
                $cell2115 = $row8->nextCell();
                $cell2115->createTextRun('')->getFont()->setBold(true)->setSize(13);
                $cell3115 = $row8->nextCell();
                $cell3115->createTextRun('')->getFont()->setBold(true)->setSize(13);
                $cell4115 = $row8->nextCell();
                $cell4115->createTextRun('')->getFont()->setBold(true)->setSize(13);
                $cell5115 = $row8->nextCell();
                $cell5115->createTextRun('')->getFont()->setBold(true)->setSize(13);
                $cell6115 = $row8->nextCell();
                $cell6115->createTextRun('')->getFont()->setBold(true)->setSize(13);
                $cell7115 = $row8->nextCell();
                $cell7115->createTextRun('')->getFont()->setBold(true)->setSize(13);                

                $row8 = $shape->createRow();
                $cell815 = $row8->nextCell();
                $cell815->setRowSpan(2);
                $cell815->createTextRun('Tahun SPK')->getFont()->setBold(true)->setSize(13);
                $cell915 = $row8->nextCell();
                $cell915->setColSpan(2);
                $cell915->createTextRun('Prasarana')->getFont()->setBold(true)->setSize(13);
                $cell1015 = $row8->nextCell();
                $cell1015->createTextRun('Prasarana')->getFont()->setBold(true)->setSize(13);
                $cell1215 = $row8->nextCell();
                $cell1215->setColSpan(3);
                $cell1215->createTextRun('Bangunan Rumah,Ruko')->getFont()->setBold(true)->setSize(13);
                $cell1315 = $row8->nextCell();
                $cell1315->createTextRun('Bangunan Rumah,Ruko')->getFont()->setBold(true)->setSize(13);
                $cell1415 = $row8->nextCell();
                $cell1415->createTextRun('Bangunan Rumah,Ruko')->getFont()->setBold(true)->setSize(13);
                $cell1515 = $row8->nextCell();
                $cell1515->setColSpan(2);
                $cell1515->createTextRun('Total')->getFont()->setBold(true)->setSize(13);
               
                $row8 = $shape->createRow();
                $cell1715 = $row8->nextCell();
                $cell1715->createTextRun('')->getFont()->setBold(true)->setSize(13);
                $cell1815 = $row8->nextCell();
                $cell1815->createTextRun('Rp[Juta].')->getFont()->setBold(true)->setSize(13);
                $cell1915 = $row8->nextCell();
                $cell1915->createTextRun('LT(m2)')->getFont()->setBold(true)->setSize(13);
                $cell2115 = $row8->nextCell();
                $cell2115->createTextRun('Rp[Juta].')->getFont()->setBold(true)->setSize(13);
                $cell2215 = $row8->nextCell();
                $cell2215->createTextRun('unit')->getFont()->setBold(true)->setSize(13);
                $cell2315 = $row8->nextCell();
                $cell2315->createTextRun('LB(m2)')->getFont()->setBold(true)->setSize(13);
                $cell2415 = $row8->nextCell();
                $cell2415->createTextRun('Total Unit')->getFont()->setBold(true)->setSize(13);
                $cell2015 = $row8->nextCell();
                $cell2015->createTextRun('Rp[Juta]')->getFont()->setBold(true)->setSize(13);

                $row8 = $shape->createRow();
                $cell3315 = $row8->nextCell();
                $cell3315->setColSpan(8);
                $cell3315->createTextRun('ON DEVELOPMENT')->getFont()->setBold(true)->setSize(13);

                foreach ($project->unit_stock_terbangun as $key15 => $value15) {
                    $row8 = $shape->createRow();
                    $cell1715 = $row8->nextCell();
                    $cell1715->createTextRun($value15['name'])->getFont()->setBold(true)->setSize(13);
                    $cell1815 = $row8->nextCell();
                    $cell1815->createTextRun('-')->getFont()->setBold(true)->setSize(13);
                    $cell1915 = $row8->nextCell();
                    $cell1915->createTextRun('-')->getFont()->setBold(true)->setSize(13);
                    $cell2115 = $row8->nextCell();
                    $cell2115->createTextRun(number_format($value15['terjual'] / 1000000),2)->getFont()->setBold(true)->setSize(13);
                    $cell2215 = $row8->nextCell();
                    $cell2215->createTextRun($value15['stock'])->getFont()->setBold(true)->setSize(13);
                    $cell2315 = $row8->nextCell();
                    $cell2315->createTextRun($value15['luas_bangunan'])->getFont()->setBold(true)->setSize(13);
                    $cell2415 = $row8->nextCell();
                    $cell2415->createTextRun($value15['stock'])->getFont()->setBold(true)->setSize(13);
                    $cell2015 = $row8->nextCell();
                    $cell2015->createTextRun(number_format($value15['terjual'],2))->getFont()->setBold(true)->setSize(13);
                }

                $row8 = $shape->createRow();
                $cell3315 = $row8->nextCell();
                $cell3315->setColSpan(8);
                $cell3315->createTextRun('FUTURE DEVELOPMENT')->getFont()->setBold(true)->setSize(13);                
            }elseif ( $i == 16 ){
                $nilai_prasarana = 0;
                $nilai_bangunan  = 0;
                foreach ($project->budget_tahunans as $key16a => $value16a) {
                    if ( $value16a->tahun_anggaran == date("Y")){
                        $nilai_prasarana = ( $value16a->nilai ) - ($value16a->nilai_cash_out_con_cost + $value16a->carry_nilai_con_cost) ;
                        $nilai_bangunan = $value16a->nilai_cash_out_con_cost + $value16a->carry_nilai_con_cost;
                    }

                }

                $shape = $slide->createRichTextShape();
                $shape->setHeight(200);
                $shape->setWidth(600);
                $shape->setOffsetX(450);
                $shape->setOffsetY(30);
                $shape->getActiveParagraph()->getAlignment()->setHorizontal( Alignment::HORIZONTAL_LEFT );
                $textRun = $shape->createTextRun("| BUDGET ".date("Y"));
                $textRun->getFont()->setBold(true);
                $textRun->getFont()->setSize(20);
                $textRun->getFont()->setColor($colorBlack);
                $shape->createBreak();

                $shape = $slide->createTableShape(7);
                $shape->setWidth(900);
                $shape->setOffsetX(20);
                $shape->setOffsetY(250);

                $row8 = $shape->createRow();
                $cell0116 = $row8->nextCell();
                $cell0116->createTextRun('')->getFont()->setBold(true)->setSize(13);
                $cell1116 = $row8->nextCell();
                $cell1116->createTextRun('')->getFont()->setBold(true)->setSize(13);
                $cell2116 = $row8->nextCell();
                $cell2116->createTextRun('')->getFont()->setBold(true)->setSize(13);
                $cell3116 = $row8->nextCell();
                $cell3116->createTextRun('')->getFont()->setBold(true)->setSize(13);
                $cell4116 = $row8->nextCell();
                $cell4116->createTextRun('')->getFont()->setBold(true)->setSize(13);
                $cell5116 = $row8->nextCell();
                $cell5116->createTextRun('')->getFont()->setBold(true)->setSize(13);
                $cell6116 = $row8->nextCell();
                $cell6116->createTextRun('')->getFont()->setBold(true)->setSize(13);              

                $row8 = $shape->createRow();
                $cell816 = $row8->nextCell();
                $cell816->setRowSpan(2);
                $cell816->createTextRun('Tahun SPK')->getFont()->setBold(true)->setSize(13);
                $cell916 = $row8->nextCell();
                $cell916->setColSpan(2);
                $cell916->createTextRun('Prasarana')->getFont()->setBold(true)->setSize(13);
                $cell1016 = $row8->nextCell();
                $cell1016->createTextRun('Prasarana')->getFont()->setBold(true)->setSize(13);
                $cell1216 = $row8->nextCell();
                $cell1216->setColSpan(2);
                $cell1216->createTextRun('Bangunan Rumah,Ruko')->getFont()->setBold(true)->setSize(13);
                $cell1316 = $row8->nextCell();
                $cell1316->createTextRun('Bangunan Rumah,Ruko')->getFont()->setBold(true)->setSize(13);
                $cell1516 = $row8->nextCell();
                $cell1516->setColSpan(2);
                $cell1516->createTextRun('Total')->getFont()->setBold(true)->setSize(13);
               
                $row8 = $shape->createRow();
                $cell1716 = $row8->nextCell();
                $cell1716->createTextRun('')->getFont()->setBold(true)->setSize(13);
                $cell1816 = $row8->nextCell();
                $cell1816->createTextRun('Rp[Juta].')->getFont()->setBold(true)->setSize(13);
                $cell1916 = $row8->nextCell();
                $cell1916->createTextRun('%')->getFont()->setBold(true)->setSize(13);
                $cell2116 = $row8->nextCell();
                $cell2116->createTextRun('Rp[Juta].')->getFont()->setBold(true)->setSize(13);
                $cell2216 = $row8->nextCell();
                $cell2216->createTextRun('%')->getFont()->setBold(true)->setSize(13);
                $cell2416 = $row8->nextCell();
                $cell2416->createTextRun('Rp[juta]')->getFont()->setBold(true)->setSize(13);
                $cell2016 = $row8->nextCell();
                $cell2016->createTextRun('%')->getFont()->setBold(true)->setSize(13);

                $row8 = $shape->createRow();
                $cell2516 = $row8->nextCell();
                $cell2516->createTextRun('Hutang Bayar')->getFont()->setBold(true)->setSize(13);
                $cell2616 = $row8->nextCell();
                $cell2616->createTextRun(number_format($project->hutang_bayar / 1000000),2)->getFont()->setBold(true)->setSize(13);
                $cell2716 = $row8->nextCell();
                $cell2716->createTextRun(number_format(($prosen1 = $project->hutang_bayar / ($project->hutang_bayar + $project->hutang_bangun)) * 100 ,2))->getFont()->setBold(true)->setSize(13);
                $cell2816 = $row8->nextCell();
                $cell2816->createTextRun(number_format($project->nilai_hutang_bayar_con_cost/ 1000000),2)->getFont()->setBold(true)->setSize(13);
                $cell2916 = $row8->nextCell();

                if ( $project->hutang_bangun_concost > 0 && $project->hutang_bayar_con_cost > 0 ){
                    $cell2916->createTextRun(number_format($prosen3 = $project->nilai_hutang_bayar_con_cost / ($project->hutang_bangun_concost + $project->hutang_bayar_con_cost)) * 100, 2)->getFont()->setBold(true)->setSize(13);
                    $cell3016 = $row8->nextCell();
                    $cell3016->createTextRun(number_format(($project->hutang_bayar + $project->hutang_bayar_con_cost) / 1000000,2))->getFont()->setBold(true)->setSize(13);
                    $cell3116 = $row8->nextCell();
                    $cell3116->createTextRun('')->getFont()->setBold(true)->setSize(13);
                }else{
                    $prosen3 = 0;
                     $cell2916->createTextRun(number_format($prosen3))->getFont()->setBold(true)->setSize(13);
                    $cell3016 = $row8->nextCell();
                    $cell3016->createTextRun(number_format(($project->hutang_bayar + $project->hutang_bayar_con_cost) / 1000000,2))->getFont()->setBold(true)->setSize(13);
                    $cell3116 = $row8->nextCell();
                    $cell3116->createTextRun('')->getFont()->setBold(true)->setSize(13);
                }


                $row8 = $shape->createRow();
                $cell3216 = $row8->nextCell();
                $cell3216->createTextRun('Hutang Bangun')->getFont()->setBold(true)->setSize(13);
                $cell3316 = $row8->nextCell();
                $cell3316->createTextRun(number_format($project->hutang_bangun / 1000000),2)->getFont()->setBold(true)->setSize(13);
                $cell3416 = $row8->nextCell();
                $cell3416->createTextRun(number_format(($prosen2 = $project->hutang_bangun / ($project->hutang_bayar + $project->hutang_bangun)) * 100 ,2))->getFont()->setBold(true)->setSize(13);
                $cell3516 = $row8->nextCell();
                $cell3516->createTextRun(number_format(($project->hutang_bangun_concost / 1000000),2))->getFont()->setBold(true)->setSize(13);
                if ( $project->hutang_bangun_concost > 0 ){
                    $cell3616 = $row8->nextCell();
                    $cell3616->createTextRun(number_format($prosen4 = $project->hutang_bangun_concost / ($project->hutang_bangun_concost + $project->hutang_bayar_con_cost)) * 100, 2)->getFont()->setBold(true)->setSize(13);
                    $cell3716 = $row8->nextCell();
                    $cell3716->createTextRun(number_format(($project->hutang_bangun_concost + $project->hutang_bangun ) / 1000000,2))->getFont()->setBold(true)->setSize(13);
                    $cell3816 = $row8->nextCell();
                    $cell3816->createTextRun('')->getFont()->setBold(true)->setSize(13);
                }else{
                    $prosen4 = 0;
                    $cell3616 = $row8->nextCell();
                    $cell3616->createTextRun(number_format($prosen4))->getFont()->setBold(true)->setSize(13);
                    $cell3716 = $row8->nextCell();
                    $cell3716->createTextRun(number_format(($project->hutang_bangun_concost + $project->hutang_bangun ) / 1000000,2))->getFont()->setBold(true)->setSize(13);
                    $cell3816 = $row8->nextCell();
                    $cell3816->createTextRun('')->getFont()->setBold(true)->setSize(13);
                }   

                $row8 = $shape->createRow();
                $cell3916 = $row8->nextCell();
                $cell3916->createTextRun('Total')->getFont()->setBold(true)->setSize(13);
                $cell4016 = $row8->nextCell();
                $cell4016->createTextRun(number_format((($project->hutang_bayar + $project->hutang_bangun) / 1000000),2))->getFont()->setBold(true)->setSize(13);
                $cell4116 = $row8->nextCell();
                $cell4116->createTextRun(number_format($prosen2 + $prosen1))->getFont()->setBold(true)->setSize(13);
                $cell4216 = $row8->nextCell();
                $cell4216->createTextRun(number_format((($project->nilai_hutang_bayar_con_cost + $project->hutang_bangun_concost) / 1000000),2))->getFont()->setBold(true)->setSize(13);
                $cell4316 = $row8->nextCell();
                $cell4316->createTextRun($prosen3 + $prosen4)->getFont()->setBold(true)->setSize(13);
                $cell4416 = $row8->nextCell();
                $cell4416->createTextRun(number_format(($project->nilai_hutang_bayar_con_cost + $project->hutang_bangun_concost + $project->hutang_bayar + $project->hutang_bangun) / 1000000,2))->getFont()->setBold(true)->setSize(13);
                $cell4516 = $row8->nextCell();
                $cell4516->createTextRun('')->getFont()->setBold(true)->setSize(13);

                $row8 = $shape->createRow();
                $cell4616 = $row8->nextCell();
                $cell4616->createTextRun('Budget '.date("Y"))->getFont()->setBold(true)->setSize(13);
                $cell4716 = $row8->nextCell();
                $cell4716->createTextRun(number_format($nilai_prasarana / 1000000),2)->getFont()->setBold(true)->setSize(13);
                $cell4716->setColSpan(2);
                $cell4816 = $row8->nextCell();
                $cell4816->createTextRun(number_format($nilai_bangunan / 1000000),2)->getFont()->setBold(true)->setSize(13);
                $cell4916 = $row8->nextCell();
                $cell4916->createTextRun(number_format(($nilai_prasarana + $nilai_bangunan) / 1000000,2))->getFont()->setBold(true)->setSize(13);
                $cell4916->setColSpan(2);
                $cell5016 = $row8->nextCell();
                $cell5016->createTextRun('')->getFont()->setBold(true)->setSize(13);
                $cell5116 = $row8->nextCell();
                $cell5116->createTextRun('')->getFont()->setBold(true)->setSize(13);
                $cell5116->setColSpan(2);
                $cell5216 = $row8->nextCell();
                $cell5216->createTextRun('')->getFont()->setBold(true)->setSize(13);
            }elseif ( $i == 17 ){

            }elseif ( $i == 18){
                $shape = $slide->createRichTextShape();
                $shape->setHeight(200);
                $shape->setWidth(600);
                $shape->setOffsetX(450);
                $shape->setOffsetY(30);
                $shape->getActiveParagraph()->getAlignment()->setHorizontal( Alignment::HORIZONTAL_LEFT );
                $textRun = $shape->createTextRun("| ANALISA DEVELOPMENT COST ");
                $textRun->getFont()->setBold(true);
                $textRun->getFont()->setSize(20);
                $textRun->getFont()->setColor($colorBlack);
                $shape->createBreak();

                $shape = $slide->createTableShape(3);
                $shape->setWidth(900);
                $shape->setOffsetX(20);
                $shape->setOffsetY(250);        

                $row8 = $shape->createRow();
                $cell712 = $row8->nextCell();
                //$cell712->setWidth(45);
                $cell712->createTextRun('Items')->getFont()->setBold(true)->setSize(13);
                $cell812 = $row8->nextCell();
                $cell812->createTextRun('Satuan')->getFont()->setBold(true)->setSize(13);
                $cell912 = $row8->nextCell();
                $cell912->createTextRun('Biaya')->getFont()->setBold(true)->setSize(13);

                $row8 = $shape->createRow();
                $cell712 = $row8->nextCell();
                //$cell712->setWidth(45);
                $cell712->createTextRun('Dev Cost yang sudah dibayarkan s/d '.date("d/m/Y"))->getFont()->setBold(true)->setSize(13);
                $cell812 = $row8->nextCell();
                $cell812->createTextRun('Rp[juta]')->getFont()->setBold(true)->setSize(13);
                $cell912 = $row8->nextCell();
                $cell912->createTextRun(number_format($project->dev_cost_terbayar / 1000000),2)->getFont()->setBold(true)->setSize(13);

                $row8 = $shape->createRow();
                $cell712 = $row8->nextCell();
                //$cell712->setWidth(45);
                $cell712->createTextRun('Dev Cost yang sudah dibebankan ke HPP.')->getFont()->setBold(true)->setSize(13);
                $cell812 = $row8->nextCell();
                $cell812->createTextRun('Rp[juta]')->getFont()->setBold(true)->setSize(13);
                $cell912 = $row8->nextCell();
                $cell912->createTextRun(number_format($project->dev_cost_dibebankan / 1000000),2)->getFont()->setBold(true)->setSize(13);

                $row8 = $shape->createRow();
                $cell712 = $row8->nextCell();
                //$cell712->setWidth(45);
                $cell712->createTextRun('Persediaan Dev Cost')->getFont()->setBold(true)->setSize(13);
                $cell812 = $row8->nextCell();
                $cell812->createTextRun('Rp[juta]')->getFont()->setBold(true)->setSize(13);
                $cell912 = $row8->nextCell();
                $cell912->createTextRun(number_format($project->persediaan_dev_cost / 1000000),2)->getFont()->setBold(true)->setSize(13);

                $row8 = $shape->createRow();
                $cell712 = $row8->nextCell();
                //$cell712->setWidth(45);
                $cell712->createTextRun('Hutang Bayar')->getFont()->setBold(true)->setSize(13);
                $cell812 = $row8->nextCell();
                $cell812->createTextRun('Rp[juta]')->getFont()->setBold(true)->setSize(13);
                $cell912 = $row8->nextCell();
                $cell912->createTextRun(number_format($project->hutang_bayar / 1000000),2)->getFont()->setBold(true)->setSize(13);

                $row8 = $shape->createRow();
                $cell712 = $row8->nextCell();
                //$cell712->setWidth(45);
                $cell712->createTextRun('Hutang Bangun.')->getFont()->setBold(true)->setSize(13);
                $cell812 = $row8->nextCell();
                $cell812->createTextRun('Rp[juta]')->getFont()->setBold(true)->setSize(13);
                $cell912 = $row8->nextCell();
                $cell912->createTextRun(number_format($project->hutang_bangun / 1000000),2)->getFont()->setBold(true)->setSize(13);

                $row8 = $shape->createRow();
                $cell712 = $row8->nextCell();
                //$cell712->setWidth(45);
                $cell712->createTextRun('Total')->getFont()->setBold(true)->setSize(13);
                $cell812 = $row8->nextCell();
                $cell812->createTextRun('Rp[juta]')->getFont()->setBold(true)->setSize(13);
                $cell912 = $row8->nextCell();
                $cell912->createTextRun(number_format($project->total_devcost / 1000000),2)->getFont()->setBold(true)->setSize(13);

                $row8 = $shape->createRow();
                $cell712 = $row8->nextCell();
                //$cell712->setWidth(45);
                $cell712->createTextRun('Luas Gross')->getFont()->setBold(true)->setSize(13);
                $cell812 = $row8->nextCell();
                $cell812->createTextRun('m2')->getFont()->setBold(true)->setSize(13);
                $cell912 = $row8->nextCell();
                $cell912->createTextRun(number_format($project->luas_gross_hpp),2)->getFont()->setBold(true)->setSize(13);

                if ( $project->netto > 0 ){
                    $eff = ($project->netto / $project->luas) * 100;
                }else{
                    $eff = 0;
                }

                $row8 = $shape->createRow();
                $cell712 = $row8->nextCell();
                //$cell712->setWidth(45);
                $cell712->createTextRun('Efisiensi')->getFont()->setBold(true)->setSize(13);
                $cell812 = $row8->nextCell();
                $cell812->createTextRun('%')->getFont()->setBold(true)->setSize(13);
                $cell912 = $row8->nextCell();
                $cell912->createTextRun(number_format($eff),2)->getFont()->setBold(true)->setSize(13);

                $row8 = $shape->createRow();
                $cell712 = $row8->nextCell();
                //$cell712->setWidth(45);
                $cell712->createTextRun('Luas Sellable Stock')->getFont()->setBold(true)->setSize(13);
                $cell812 = $row8->nextCell();
                $cell812->createTextRun('m2')->getFont()->setBold(true)->setSize(13);
                $cell912 = $row8->nextCell();
                $cell912->createTextRun(number_format($project->netto),2)->getFont()->setBold(true)->setSize(13);

                $row8 = $shape->createRow();
                $cell712 = $row8->nextCell();
                //$cell712->setWidth(45);
                $cell712->createTextRun('Sudah dibukukan ( backlog)')->getFont()->setBold(true)->setSize(13);
                $cell812 = $row8->nextCell();
                $cell812->createTextRun('m2')->getFont()->setBold(true)->setSize(13);
                $cell912 = $row8->nextCell();
                $cell912->createTextRun(number_format($project->total_stock),2)->getFont()->setBold(true)->setSize(13);

                $row8 = $shape->createRow();
                $cell712 = $row8->nextCell();
                //$cell712->setWidth(45);
                $cell712->createTextRun('Devcost')->getFont()->setBold(true)->setSize(13);
                $cell812 = $row8->nextCell();
                $cell812->createTextRun('Rp/m2')->getFont()->setBold(true)->setSize(13);
                $cell912 = $row8->nextCell();
                $cell912->createTextRun(number_format($project->hpp_devcost_upd),2)->getFont()->setBold(true)->setSize(13);
            }elseif ( $i == 19 ){
                foreach ($project->unittype as $key19a => $value19a) {                    
                    $slide = $objPHPPowerPoint->createSlide();
                    $shape = $slide->createRichTextShape();
                    $shape->setHeight(200);
                    $shape->setWidth(600);
                    $shape->setOffsetX(450);
                    $shape->setOffsetY(30);
                    $shape->getActiveParagraph()->getAlignment()->setHorizontal( Alignment::HORIZONTAL_LEFT );
                    $textRun = $shape->createTextRun("| RINCIAN HPP BANGUNAN ");
                    $textRun->getFont()->setBold(true);
                    $textRun->getFont()->setSize(20);
                    $textRun->getFont()->setColor($colorBlack);
                    $shape->createBreak();

                    $shape = $slide->createRichTextShape();
                    $shape->setHeight(200);
                    $shape->setWidth(900);
                    $shape->setOffsetX(20);
                    $shape->setOffsetY(180);
                    $shape->getActiveParagraph()->getAlignment()->setHorizontal( Alignment::HORIZONTAL_LEFT );
                    $textRun = $shape->createTextRun('EVALUASI HARGA POKOK BANGUNAN '. $value19a->name) ;
                    $textRun->getFont()->setBold(true);
                    $textRun->getFont()->setSize(18);
                    $textRun->getFont()->setColor($colorBlack);
                    $shape->createBreak();

                    
                }
            }