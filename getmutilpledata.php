<?php
$gene=$_POST["gene"];//"ALK";//
$host="db1.mgmt.hpc.mssm.edu";
$uname="wangj27";
$pass="snoopy";
$database = "kb_CancerVariant_Curation";	
$myresult=array();
$connection=mysql_connect($host,$uname,$pass); 

echo mysql_error();

//or die("Database Connection Failed");
$selectdb=mysql_select_db($database) or die("Database could not be selected");	
$result=mysql_select_db($database)
or die("database cannot be selected <br>");

	


$query="select Types from kb_CancerVariant_Curation.IPA_ontology where Symbol='".$gene."'";
$sql = mysql_query($query);
if(mysql_num_rows($sql)==0){
	$myresult["ontology_term"]="Not avaliable";
}

while ($row = mysql_fetch_array($sql)) {
  $myresult["ontology_term"]=$row[0];
}
$query="select role_in_caner from kb_CancerVariant_Curation.census_all_COSMIC where gene='".$gene."'";
$sql = mysql_query($query);
if(mysql_num_rows($sql)==0){
	$myresult["Role_in_cancer"]="Not avaliable";
}

while ($row = mysql_fetch_array($sql)) {
  $myresult["Role_in_cancer"]=$row[0];
}
$query="select Foundation, Foundation_rearrangement, Hotspot, MSK, Oncomine from kb_CancerVariant_Curation.Panel_5all where Gene='".$gene."'";

$sql = mysql_query($query);
if(mysql_num_rows($sql)==0){
	$myresult["foundation"]="Not avaliable";
	$myresult["rearragement"]="Not avaliable";
	$myresult["hotspots"]="Not avaliable";
	$myresult["msk"]="Not avaliable";
	$myresult["oncomine"]="Not avaliable";
	
}

while ($row = mysql_fetch_array($sql)) {
  $myresult["foundation"]=$row[0];
	$myresult["rearragement"]=$row[1];
	$myresult["hotspots"]=$row[2];
	$myresult["msk"]=$row[3];
	$myresult["oncomine"]=$row[4];
}

$query="select somatic,  tumor_type_somatic, germline, tumor_type_germline from kb_CancerVariant_Curation.census_all_COSMIC where gene='".$gene."'";

$sql = mysql_query($query);
if(mysql_num_rows($sql)==0){
	$myresult["somatic"]="Not avaliable";
	$myresult["tumour_types_somatic"]="Not avaliable";
	$myresult["germline"]="Not avaliable";
	$myresult["tumour_types_germline"]="Not avaliable";
	//$myresult["oncomine"]="Not avaliable";
	//id="somatic" id="tumour_types_somatic" id="germline" id="tumour_types_germline"
	
}

while ($row = mysql_fetch_array($sql)) {
  $myresult["somatic"]=$row[0];
	$myresult["tumour_types_somatic"]=$row[1];
	$myresult["germline"]=$row[2];
	$myresult["tumour_types_germline"]=$row[3];
	
}
$query="select `BLCA Freq`, `BRCA Freq`, `COADREAD Freq`, `GBM Freq`, `HNSC Freq`, `KIRC Freq`, `LAML Freq`, `LUAD Freq`, `LUSC Freq`, `OV Freq`, `UCEC Freq`, `Pancan12 Freq`,Gene from kb_CancerVariant_Curation.TCGA12Cancers where Gene='".$gene."'";
$sql = mysql_query($query);
if(mysql_num_rows($sql)==0){
	$myresult["BLCA"]="Not avaliable";
	$myresult["BRCA"]="Not avaliable";
	$myresult["COADREAD"]="Not avaliable";
	$myresult["GBM"]="Not avaliable";
	
	$myresult["HNSC"]="Not avaliable";
	$myresult["KIRC"]="Not avaliable";
	$myresult["LAML"]="Not avaliable";
	$myresult["LUAD"]="Not avaliable";
	
	$myresult["LUSC"]="Not avaliable";
	$myresult["OV"]="Not avaliable";
	$myresult["UCEC"]="Not avaliable";
	$myresult["Pancan12"]="Not avaliable";
	//$myresult["oncomine"]="Not avaliable";
	//d="BLCA" id="BRCA"  id="COADREAD" id="GBM"  id="HNSC" id="KIRC" id="LAML" id="LUAD" id="LUSC" id="OV" id="UCEC" id="Pancan12" id="cbiop_URL"
	
}

while ($row = mysql_fetch_array($sql)) {
	$index=0;
    $myresult["BLCA"]=$row[$index++];
	$myresult["BRCA"]=$row[$index++];
	$myresult["COADREAD"]=$row[$index++];
	$myresult["GBM"]=$row[$index++];
	
	$myresult["HNSC"]=$row[$index++];
	$myresult["KIRC"]=$row[$index++];
	$myresult["LAML"]=$row[$index++];
	$myresult["LUAD"]=$row[$index++];
	
	$myresult["LUSC"]=$row[$index++];
	$myresult["OV"]=$row[$index++];
	$myresult["UCEC"]=$row[$index++];
	$myresult["Pancan12"]=$row[$index++];
	
}

$query="select pathway from  kb_CancerVariant_Curation.my_cg_pathway where gene='".$gene."'";
$sql = mysql_query($query);
if(mysql_num_rows($sql)==0){
	$myresult["MyCancerGenome_Pathway"]="Not avaliable";
}

while ($row = mysql_fetch_array($sql)) {
	$index=0;
    $myresult["MyCancerGenome_Pathway"]="<a  href='https://www.mycancergenome.org/content/molecular-medicine/pathways/'".$row[0]." target='_blank'>RTK-growth-factor-signaling</a>";
}
//<a id="MyCancerGenome_Pathway" href="https://www.mycancergenome.org/content/molecular-medicine/pathways/" target="_blank">RTK-growth-factor-signaling</a></td><!--select pathway from  proj_PCT. my_cg_pathway where gene="ALK";-->
//						<td  id="Signaling_pathway" style="border:2px solid #fff;background-color:#F9F2E7;text-align:left;padding: 5px;">
//							RTK</td><!--select pathway from proj_PCT.signaling_pathways where symbol ="ALK";-->
//						<td  style="border:2px solid #fff;background-color:#F9F2E7;text-align:left;padding: 5px;">
//							<a id="KEGG_pathway" 

$ou=json_encode($myresult);



echo $ou;

?>