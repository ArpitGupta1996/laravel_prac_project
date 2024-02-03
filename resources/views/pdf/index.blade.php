<?php $categories = [];
    $positives = [];
    $negatives=[];
    $main_parameter = $audit_data_trend[$current_camp]['param_wise'];
    krsort($main_parameter);
    foreach($main_parameter as $k=>$param) {
        $categories[]= $param['name'];
            if($param['scorable'] != 0) {
                $positives[] =($param['scorable'] != 0) ? round(($param['scored']/$param['scorable'])*100) : 0;
                $negatives[] = (float)((round(($param['scored']/$param['scorable'])*100)-100) == 0) ? -0.01 : round(($param['scored']/$param['scorable'])*100)-100;
            } else {
                $positives[] = (float)0;
                $negatives[] = (float)-0.01;
            }
    }



    // echo "<pre>";
    // print_r($categories);
    // print_r($positives);
    // print_r($negatives);
    //  die;
     $num=json_encode($negatives);
    //echo json_encode($output,JSON_NUMERIC_CHECK);
     //die;


     ?>
<style>

    body,html{
        width:100%;
        height:100%;
        padding: 0px;
        margin: 0px;
overflow: hidden;
    }
    .overlay{
        background: rgba(0,0,0,.95);
        width: 100%;
        height: 100%;
        position: absolute;
        top: 0px;
        z-index: 1;
    }
    .loader {
        border: 16px solid #f3f3f3; /* Light grey */
        border-top: 16px solid #3498db; /* Blue */
        border-radius: 50%;
        width: 120px;
        height: 120px;
        animation: spin 2s linear infinite;
        position: absolute;
        z-index: 2;
        left: 0;
        right: 0;
        margin: auto;
        top: 25%;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    .text{
        color: white;
        position: absolute;
        z-index: 2;
        left: 0;
        right: 0;
        margin: auto;
        text-align: center;
        margin-top: 166px;
    }

</style>
<div style="position: relative;top: 25%;">
    <div class="loader"></div>
    <p class="text"> Generating Report Please wait... </p>
</div>
    <div class="overlay"></div>


<?php

function ccode($v){
    if($v <= 50){
        return  '#ee746d';
    }
    if($v >= 41 && $v <= 70){
        return  '#f7b952';
    }
    if($v >= 65 && $v <= 95){
        return  '#a9e8c0';
    }
    if($v >= 75 && $v <= 95){
        return  '#79d299';
    }
    if($v > 95){
        return  '#52c37b';
    }
}

$color='';
$score=$audit_data_trend[$current_camp]['overall_scored_fatal'];

$score1='';
$score2='';
$score3='';
$s=1;
foreach($audit_data_trend as $ad) {
    if($s==1) {
        $score1=$ad['camp'].'&'.$ad['overall_scored_fatal'];
    }
    if($s==2) {
        $score2=$ad['camp'].'&'.$ad['overall_scored_fatal'];
    }
    if($s==3) {
        $score2=$ad['camp'].'&'.$ad['overall_scored_fatal'];
    }
    $s++;
}

if(!empty($score1)){
   $color .= "'".ccode(explode('&', $score1)[1])."',";

}
if(!empty($score2)){
  $color .= "'".ccode(explode('&', $score2)[1])."',";

}
if(!empty($score3)){
   $color .= "'".ccode(explode('&', $score3)[1])."',";

}
//$color= "'".$first[2]."','".$seconed[2]."','".$third[2]."'";
//print_r($color);
$beatplan_id = $beatplanstore->id;
$urllink=url('pdf_report_download').'/'.$beatplan_id.'';

?>


    <script src="{{asset('pdf/jquery.min.js')}}"></script>
    <script src="{{asset('pdf/zingchart.min.js')}}" ></script>
    <style type="text/css">
        #myChart {
            height:100%;
            width:100%;
            min-height:150px;
        }
        .zc-ref {
            display: none;
        }
    </style>
    <div id='myChart'></div>

    <script type="text/javascript" >
        var base_url = window.location.origin;
        window.feed = function (callback) {
            var tick = {};
            tick.plot0 = Math.ceil(350 + (Math.random() * 500));
            callback(JSON.stringify(tick));
        };
        var myConfig = {
            type: "gauge",
            globals: {
                fontSize: 15
            },
            plotarea: {
                marginTop: 50
            },
            plot: {
                size: '100%',
            },
            tooltip: {
                borderRadius: 5
            },
            scaleR: {
                aperture: 180,
                minValue: 0,
                maxValue: 100,
                step: 10,
                center: {
                    visible: false
                },
                tick: {
                    visible: true,
                    lineColor: 'white',
                },
                item: {
                    offsetR: 0,
                    rules: [
                        {
                            rule: '%i == 9',
                            offsetX: 15
                        }
                    ]
                },
                labels: ['0', '10', '20', '30', '40', '50', '60', '70', '80', '90', '100'],
                ring: {
                    size: 50,
                    rules: [
                        {
                            rule: '%v <= 50',
                            backgroundColor: '#ee746d'
                        }, {
                            rule: '%v >= 41 && %v <= 70',
                            backgroundColor: '#f7b952'
                        }, {
                            rule: '%v >= 65 && %v <= 95',
                            backgroundColor: '#a9e8c0'
                        }, {
                            rule: '%v >= 75 && %v <= 95',
                            backgroundColor: '#79d299'
                        }, {
                            rule: '%v > 95',
                            backgroundColor: '#52c37b'
                        }
                    ]
                }
            },
            series: [
                {
                    values: [<?php echo $score; ?>],
                    backgroundColor: 'black',
                    indicator: [15, 1, 0, 4, 10],
                }
            ]
        };
        zingchart.render({
            id: 'myChart',
            data: myConfig,
            height: 350,
            output: 'canvas',
            width: '400px'
        });
        var sImageData = zingchart.exec('myChart', 'getimagedata', {
            format: 'png'
        });
    //        $( "head" ).remove();
    //        $( "div" ).remove();
    //         $( "script" ).remove();
        //$( "body" ).remove();
        //$('#gchart').src(sImageData);
        var image = new Image();
        image.src = sImageData;
        var filename = 'gauage_<?php echo $beatplan_id; ?>.png';
        downloadnew(sImageData, filename);

        function downloadnew(sImageData, filename) {

            var b = document.createElement('b');
            b.download = filename;
            save_img_new(sImageData, filename);

        }
        function save_img_new(sImageData, filename) {
          //  alert('yes');
            $.ajax({
              type: "POST",
              url: base_url + "/save_png",
              data:{data: sImageData, filename: filename},
              success: function(Data){
                }
            });
        }


        document.body.appendChild(image);


    </script>


 <div style="display: none">

</div>

<div id="container" style="min-width: 310px; max-width: 800px; height: 400px; margin: 0 auto"></div>

<script src="{{asset('pdf/highcharts.js')}}"></script>
<script src="{{asset('pdf/exporting.js')}}"></script>
<script type="text/javascript">
    var truescore = [];
    <?php if(!empty($score1)){ ?>
    truescore.push({
                        name: "<?php echo!empty($score1) ?  explode('&', $score1)[0] : 'Most Previous'; ?> ",
                        y: <?php echo!empty($score1) ? explode('&', $score1)[1] : 0; ?>,
                        //drilldown: "Chrome"
                    });
    <?php } ?>
    <?php if(!empty($score2)){ ?>
    truescore.push({
                        name: "<?php echo!empty($score2) ? trim(explode('&', $score2)[0]) : 'Previous'; ?>",
                        y: <?php echo!empty($score2) ? trim(explode('&', $score2)[1]) : 0; ?>,
                        //drilldown: "Firefox"
                    });
    <?php } ?>
    <?php if(!empty($score3)){ ?>
    truescore.push({
                        name: "<?php echo!empty($score3) ? explode('&', $score3)[0] : 'Recent'; ?> ",
                        y: <?php echo!empty($score3) ? explode('&', $score3)[1] : 0; ?>,
                        //drilldown: "Internet Explorer"
                    });
    <?php } ?>
    Highcharts.chart('container', {
        colors: [<?php echo $color; ?>],
        chart: {
            type: 'column'
        },
        title: {
            text: null
        },
        subtitle: {
            text: null
        },
        xAxis: {
            gridLineWidth: 0,
            type: 'category'
        },
        yAxis: {
            gridLineWidth: 0,
            title: {
                text: ''
            }
        },
        legend: {
            enabled: false
        },
        plotOptions: {
            series: {
                borderWidth: 0,
                dataLabels: {
                    enabled: true,
                    format: '{point.y:.1f}%'
                }
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
        },
        series: [
            {
                pointWidth: 40,
                name: "Browsers",
                colorByPoint: true,
                data: truescore,
            }
        ],
        credits: {
            enabled: false
        },
    });

    (function (H) {
        var chartnew = $('#container').highcharts();

        var render_width = 800;
        var render_height = render_width * chartnew.chartHeight / chartnew.chartWidth

        var svg = chartnew.getSVG({
            exporting: {
                sourceWidth: chartnew.chartWidth,
                sourceHeight: chartnew.chartHeight
            }
        });

        var canvasnew = document.createElement('canvas');
        canvasnew.height = render_height;
        canvasnew.width = render_width;

        var imagenew = new Image;
        imagenew.onload = function () {
         //  alert('ok');
            canvasnew.getContext('2d').drawImage(this, 0, 0, render_width, render_height);
            var data = canvasnew.toDataURL("image/png");
             downloadnew(data, 'trendchart_<?php echo $beatplan_id; ?>.png');
            //    alert(data);
            // var image = new Image();
            // image.src = data;
            document.body.appendChild(imagenew);
          //  document.html.appendChild(image);
            // $('#p').html() = data;
            //download(data, filename + '.png');
        }
        imagenew.src = 'data:image/svg+xml;base64,' + window.btoa(svg);
      //  $("head").remove();
      //  $("div").remove();
      //  $("script").remove();


    }(Highcharts));
    function downloadnew(data, filename) {

        var b = document.createElement('b');
        b.download = filename;
        save_img_new(data, filename);

    }
    function save_img_new(data, filename) {
      //  alert('yes');
        $.ajax({
          type: "POST",
          url: base_url + "/save_png",
          data:{data: data, filename: filename},
          success: function(Data){
            }
        });
    }
</script>


<div id="containernew" style="min-width: 310px; max-width: 800px; height: 400px; margin: 0 auto"></div>

<script type="text/javascript">

    var categories = <?php echo json_encode($categories); ?>;

    Highcharts.chart('containernew', {
        colors: ['#f87b60', '#3fce32'],
        chart: {
            type: "bar"
        },
        title: {
            text: null
        },
        subtitle: {
            text: null
        },
        xAxis: [{
                gridLineWidth: 0,
                categories: categories,
                reversed: false,
                labels: {
                    step: 1,
                    style: {"color": "#000", "font-family": "Calibri", "fontSize": "10px", "fontWeight": "200", "textOutline": "0px", "line-height": "0"},
                }
            }, {// mirror axis on right side
                opposite: true,
                reversed: false,
                categories: categories,
                linkedTo: 0,
                labels: {
                    step: 1,
                    style: {"color": "#000", "font-family": "Calibri", "fontSize": "10px", "fontWeight": "200", "textOutline": "0px", "line-height": "0"},
                }
            }],
        yAxis: {
            gridLineWidth: 0,
            min: -100,
            max: 100,
            title: {
                text: null
            },
            labels: {
                formatter: function () {
                    return Math.abs(this.value) + "%";
                },
            }
        },
        plotOptions: {
            series: {
                stacking: "normal",
                dataLabels: {
                    enabled: true,
                     formatter:function(){
                    		if(this.y >=0){
                        		return	Math.abs(this.y) +'%';
                        }else{
                        		return	Math.abs(Math.round(this.y))+'%';
                        }

                    },
                   // format: '{y:.2f}%',
                    style: {"color": "#000", "font-family": "Calibri", "fontSize": "10px", "fontWeight": "200", "textOutline": "0px", "line-height": "0"},
                },
                animation: {
                    duration: 0,
                }
            },
        },
        tooltip: {
            formatter: function () {
                return "<b>" + this.series.name + ", age " + this.point.category + "</b><br/>" +
                        "Population: " + Highcharts.numberFormat(Math.abs(this.point.y), 0);
            }
        },
        //<?php //echo base64_decode($data1); ?>
        //<?php //echo base64_decode($data2); ?>

        series: [{
                name: "Non-Compliance",
                data: <?=$num;  ?>
            }, {
                name: "Compliance",
                data: [<?php $tr=0; $co=count($positives); foreach($positives as $po) { if($tr == $co) { echo $po; } else { echo $po.','; }  $tr++;} ?>]
            }],
        credits: {
            enabled: false
        },
    });
    (function (H) {
        var chart = $('#containernew').highcharts();

        var render_width = 1000;
        var render_height = render_width * chart.chartHeight / chart.chartWidth

        var svg = chart.getSVG({
            exporting: {
                sourceWidth: chart.chartWidth,
                sourceHeight: chart.chartHeight
            }
        });

        var canvas = document.createElement('canvas');
        canvas.height = render_height;
        canvas.width = render_width;

        var image = new Image;
        image.onload = function () {
            canvas.getContext('2d').drawImage(this, 0, 0, render_width, render_height);
            var data = canvas.toDataURL("image/png");
            download(data, 'genchart_<?php echo $beatplan_id; ?>.png');
            document.body.appendChild(image);
        }
        image.src = 'data:image/svg+xml;base64,' + window.btoa(svg);
    }(Highcharts));

    function download(data, filename) {

        var a = document.createElement('a');
        a.download = filename;
        save_img(data, filename);

    }

     function save_img(data, filename) {

        $.ajax({
          type: "POST",
          url: base_url + "/save_png",
          data:{data: data, filename: filename},
          success: function(Data){
            }
        });
//         $("head").remove();
//        $("div").remove();
//        $("script").remove();
//
//
        setTimeout(function(){
            window.location="<?php echo $urllink;?>";
        }, 10000);
    }

</script>


<?php
die;
?>

