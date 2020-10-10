<?php

namespace App\Http\Controllers;

use App\StudentAnswer;
use App\TeacherAnswer;
use Caxy\HtmlDiff\HtmlDiffConfig;
use Illuminate\Http\Request;
use Caxy\HtmlDiff\HtmlDiff;


class DifferenceController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($answerId)
    {
        //dd($answerId);
        $teacherAnswerOld = TeacherAnswer::where('id', $answerId)->get()->toArray()[0]['answer'];
        $id = TeacherAnswer::where('id', $answerId)->get()->toArray()[0]['answer_id'];
        $studentAnswerOld = StudentAnswer::where('id', $id)->get()->toArray()[0]['answer'];



        $studentAnswerNew = '<div>' . preg_replace('/\r\n/', '<br />', $studentAnswerOld) . '</div>';
        $teacherAnswerNew = '<div>' . preg_replace('/\r\n/', '<br />', $teacherAnswerOld) . '</div>';


//        $config = new HtmlDiffConfig();
//        $config
//            ->setSpecialCaseChars(array('.',  '(', ')', '\'' ));

        $htmlDiff = HtmlDiff::create($studentAnswerNew, $teacherAnswerNew);

        $content = $htmlDiff->build();
        //$content = str_replace('&trade;', chr(62), $content);
     //   dd($subject);
       //dd($studentAnswerNew, $teacherAnswerNew, $content);
        return view('difference.show', compact('content', 'studentAnswerNew', 'teacherAnswerNew'));

    }


    private function diff($old, $new){
        // dd($teacherAnswer, $studentAnswer);
        // $old = file_get_contents()
        //   $diff = ("asa", "bsa");
//        if (is_string($diff)) {
//            echo "Differences between two articles:\n";
//            echo $diff;
//        }
//
//        $diff =$this->diff(str_split("asa"), str_split("bsa"));
//        $diff = new HtmlDiff($studentAnswer, $teacherAnswer);
//        $answers = [
//            'teacherAnswer' => $teacherAnswer,
//            'studentAnswer' => $studentAnswer,
//            'diff' => $diff->build()
//        ];
//        var text = document.forms[0].txt.value;
//        text = text.replace(/\r?\n/g, '<br />');
        $matrix = array();
        $maxlen = 0;
        foreach($old as $oindex => $ovalue){
            $nkeys = array_keys($new, $ovalue);
            foreach($nkeys as $nindex){
                $matrix[$oindex][$nindex] = isset($matrix[$oindex - 1][$nindex - 1]) ?
                    $matrix[$oindex - 1][$nindex - 1] + 1 : 1;
                if($matrix[$oindex][$nindex] > $maxlen){
                    $maxlen = $matrix[$oindex][$nindex];
                    $omax = $oindex + 1 - $maxlen;
                    $nmax = $nindex + 1 - $maxlen;
                }
            }
        }
        if($maxlen == 0) return array(array('d'=>$old, 'i'=>$new));
        return array_merge(
           $this->diff(array_slice($old, 0, $omax), array_slice($new, 0, $nmax)),
            array_slice($new, $nmax, $maxlen),
            $this->diff(array_slice($old, $omax + $maxlen), array_slice($new, $nmax + $maxlen)));
    }
   private  function htmlDiff($old, $new){
        $ret = '';
        $diff = $this->diff(preg_split("/[\s]+/", $old), preg_split("/[\s]+/", $new));
        foreach($diff as $k){
            if(is_array($k))
                $ret .= (!empty($k['d'])?"<del>".implode(' ',$k['d'])."</del> ":'').
                    (!empty($k['i'])?"<ins>".implode(' ',$k['i'])."</ins> ":'');
            else $ret .= $k . ' ';
        }
        return $ret;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
