<?php

$arraylist = <<<'EOF'
addAttribute — Adds an attribute to the SimpleXML element
addChild — Adds a child element to the XML node
asXML — Return a well-formed XML string based on SimpleXML element
attributes — Identifies an element's attributes
children — Finds children of given node
__construct — Creates a new SimpleXMLElement object
count — Counts the children of an element
getDocNamespaces — Returns namespaces declared in document
getName — Gets the name of the XML element
getNamespaces — Returns namespaces used in document
registerXPathNamespace — Creates a prefix/ns context for the next XPath query
saveXML — Alias of asXML
__toString — Returns the string content
xpath — Runs XPath query on XML data
EOF;

$array_result = array();

foreach (explode("\n", $arraylist) as $line) {
	$function = explode(' — ', $line);
	echo "\"{$function[0]}\" => \"{$function[1]}\",\n";
}

?>