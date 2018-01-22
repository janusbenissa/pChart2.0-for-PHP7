<?php   

/* pChart library inclusions */
chdir("../../");
require_once("bootstrap.php");

use pChart\pColor;
use pChart\pDraw;
use pChart\pImageMap\pImageMapFile;
use pChart\pPie;

/* Create the pChart object */
/* 							X, Y, TransparentBackground, UniqueID, StorageFolder*/
$myPicture = new pImageMapFile(300,260,FALSE,"2DRingChart","temp");

/* Retrieve the image map */
if (isset($_GET["ImageMap"]) || isset($_POST["ImageMap"])){
	$myPicture->dumpImageMap();
	/* once called the script ends after the dump */
}

/* Populate the pData object */
$myPicture->myData->addPoints([40,60,15,10,6,4],"ScoreA");  
$myPicture->myData->setSerieDescription("ScoreA","Application A");

/* Define the abscissa series */
$myPicture->myData->addPoints(array("<10","10<>20","20<>40","40<>60","60<>80",">80"),"Labels");
$myPicture->myData->setAbscissa("Labels");

/* Draw a solid background */
$myPicture->drawFilledRectangle(0,0,300,300,["Color"=>new pColor(170,183,87), "Dash"=>TRUE, "DashColor"=>new pColor(190,203,107)]);

/* Overlay with a gradient */
$myPicture->drawGradientArea(0,0,300,260,DIRECTION_VERTICAL,["StartColor"=>new pColor(219,231,139,50), "EndColor"=>new pColor(1,138,68,50)]);

/* Add a border to the picture */
$myPicture->drawRectangle(0,0,299,259,["Color"=>new pColor(0,0,0)]);

/* Set the default font properties */ 
$myPicture->setFontProperties(array("FontName"=>"pChart/fonts/Forgotte.ttf","FontSize"=>10,"Color"=>new pColor(80,80,80)));

/* Enable shadow computing */ 
$myPicture->setShadow(TRUE,["X"=>2,"Y"=>2,"Color"=>new pColor(0,0,0,10)]);

/* Create the pPie object */ 
$PieChart = new pPie($myPicture);

/* Draw an AA pie chart */ 
$PieSettings = array("DrawLabels"=>TRUE,"LabelStacked"=>TRUE,"Border"=>TRUE,"RecordImageMap"=>TRUE);
$PieChart->draw2DRing(160,125,$PieSettings);

/* Render the picture (choose the best way) */
$myPicture->autoOutput("temp/2DRingChart.png");

?>