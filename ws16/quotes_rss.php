<?php
# very important line
@date_default_timezone_set("GMT");

# open a new MySQL connection using PDO
$pdo = new PDO('mysql:host=localhost;dbname=quotes-db', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

# formulate the SQL and run it
$sql = 'SELECT `qid`, `quote`, `s-name`, `wpimg` 
        FROM `quotes`, `source` 
        WHERE `sid` = `sid-fk` AND MONTH(`ts`) > 1';
$query = $pdo->prepare($sql);
$query->execute();

# store all the results in an array
$rss_items = $query->fetchAll();

# create a new writer object
$writer = new XMLWriter();

# output directly to browser
$writer->openURI('php://output');

# start the document with xml declaration and XSLT link
$writer->startDocument('1.0', 'UTF-8');
$writer->writePi('xml-stylesheet', 'type="text/xsl" href="quotes-feed.xsl"');

# set indent for output
$writer->setIndent(4);

# declare it as an rss document
$writer->startElement('rss');
$writer->writeAttribute('version', '2.0');
$writer->writeAttribute('xmlns:atom', 'http://www.w3.org/2005/Atom');

# start channel element
$writer->startElement("channel");
#----------------------------------------------------
$writer->writeElement('title', 'Quotes from our DB');
$writer->writeElement('description', 'This is some new quotes from our collection.');
$writer->writeElement('link', 'http://localhost/quotes/?qid=new');
$writer->writeElement('pubDate', date("D, d M Y H:i:s e"));

# image element
$writer->startElement('image');
$writer->writeElement('title', 'Quotes from our DB');
$writer->writeElement('link', 'http://localhost/quotes/?qid=all');
$writer->writeElement('url', 'http://localhost/120x68.png');
$writer->writeElement('width', '120');
$writer->writeElement('height', '68');
$writer->endElement(); # end image element
#----------------------------------------------------

# iterate through each item and create corresponding elements
foreach ($rss_items as $item) {
    $writer->startElement("item");
    $writer->writeElement('title', $item['quote'] . ' - ' . $item['s-name']);
    $writer->writeElement('link', 'http://localhost/quotes/?qid=' . $item['qid']);
    
    # description with CDATA
    $writer->startElement("description");
    $writer->startCData();
    $writer->text('<img src="' . $item['wpimg'] . '" /><p>more content</p>');
    $writer->endCData();
    $writer->endElement(); # end description
    
    # publication date
    $writer->writeElement('pubDate', date("D, d M Y H:i:s e"));

    $writer->endElement(); # end item
}

# end channel
$writer->endElement();

# end rss
$writer->endElement();

# end document
$writer->endDocument();

# set content type header
header('Content-Type: text/xml'); 

# send the output to the browser
$writer->flush();
?>

