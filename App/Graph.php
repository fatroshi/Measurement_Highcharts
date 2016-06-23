<?php

/**
 * Created by PhpStorm.
 * User: Elise
 * Date: 19/06/16
 * Time: 19:17
 */

include_once "App/Controller.php";

class Graph
{

    private $controller;

    private $title;
    private $subtitle;
    private $xAxisTitle;
    private $yAxisTitle;

    private static $graphs = array();
    private $graphCounter = 0;

    function __construct($title, $subtitle, $xAxisTitle, $yAxisTitle, $controller) {
        $this->title               = $title;
        $this->subtitle            = $subtitle;
        $this->xAxisTitle          = $xAxisTitle;
        $this->yAxisTitle          = $yAxisTitle;

        $this->controller = $controller;

        //$this->setSeries("test");
    }


    public function setXaxisData($xAxis){

        $xAxis = array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
            'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');


        $output = "";

        for ($i=0; $i<count($xAxis); $i++){

            $output .= "'{$xAxis[$i]}'";
            if($i != count($xAxis) -1){
                $output .= ", ";
            }

        }

        return $output;
    }

    public function getSeries($product_id){

        self::$graphs[] = $this->controller->getMeasurementsJSON($product_id);
        $this->graphCounter++;
    }

    public function createGraph($product_id,$id){
        $output = "<div id=\"{$id}\" class='thumbnail' style=\"width: 100%; height: 400px; margin: 0 auto\"></div>
<script language=\"JavaScript\">
    $(document).ready(function() {
        var title = {
            text: '{$this->title}'
        };
        var subtitle = {
            text: '{$this->subtitle}'
        };
        var xAxis = {
            title: {
                text: '{$this->xAxisTitle}'
            },
            categories: [";
                    // Get data
                    //$output .= $this->setXaxisData("test");

        $output .= "]
        };
        var yAxis = {
            title: {
                text: '{$this->yAxisTitle} (ms)'
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
        };

        var tooltip = {
            valueSuffix: ' ms'
        }

        var legend = {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0
        }

        var series = [";
        // Get all graphs

        for($i = 0; $i < count(self::$graphs); $i++){
            $output .= self::$graphs[$i];
            if($i != count(self::$graphs) -1){
                $output .= ", ";
            }
        }

        //$output .= $this->getSeries($product_id);

        $output .= "];
        var json = {};

        json.title = title;
        json.subtitle = subtitle;
        json.xAxis = xAxis;
        json.yAxis = yAxis;
        json.tooltip = tooltip;
        json.legend = legend;
        json.series = series;

        $('#{$id}').highcharts(json);
    });
</script>
";

        echo $output;


    }




    
}