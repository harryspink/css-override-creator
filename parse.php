<?php

require_once 'vendor/autoload.php';

$file_1 = new Sabberworm\CSS\Parser(file_get_contents($argv[1]));
$file_2 = new Sabberworm\CSS\Parser(file_get_contents($argv[2]));

function css_array_to_css($rules, $indent = 0) {
    $css = '';
    $prefix = str_repeat('  ', $indent);

    foreach ($rules as $key => $value) {
        if (is_array($value)) {
            $selector = $key;
            $properties = $value;

            $css .= $prefix . "$selector {\n";
            $css .= $prefix . css_array_to_css($properties, $indent + 1);
            $css .= $prefix . "}\n";
        } else {
            $property = $key;
            $css .= $prefix . "$property: $value;\n";
        }
    }

    return $css;
}

$file_1_parsed = $file_1->parse();
$file_2_parsed = $file_2->parse();

foreach($file_1_parsed->getAllRuleSets() as $oRuleSet) {
    $rules = [];

    foreach($oRuleSet->getRulesAssoc() as $value){
        $rules[(string)$value->getRule()] = (string)$value->getValue();
    }

    $selectors = [];
    foreach($oRuleSet->getSelectors() as $selector){
        $selectors[] = (string)$selector;
    }

    $file_1_selectors[implode(', ', $selectors)] = $rules;
}

foreach($file_2_parsed->getAllRuleSets() as $oRuleSet) {
    $rules = [];

    foreach($oRuleSet->getRulesAssoc() as $value){
        $rules[(string)$value->getRule()] = (string)$value->getValue();
    }

    $selectors = [];
    foreach($oRuleSet->getSelectors() as $selector){
        $selectors[] = (string)$selector;
    }

    $file_2_selectors[implode(', ', $selectors)] = $rules;
}

$to_add = [];
foreach($file_2_selectors as $selector => $values){
    $add = false;

    if(!isset($file_1_selectors[$selector])){
        $add = true;
    }

    if(count($values) != count($values)){
        $add = true;
    }

    $new_values = [];

    if(isset($file_1_selectors[$selector])) {

        foreach ($values as $key => $value) {
            if (!isset($file_1_selectors[$selector][$key])) {
                $add = true;
                $new_values[$key] = $value;
            } else
                if ($value != $file_1_selectors[$selector][$key]) {
                    $add = true;
                    $new_values[$key] = $value;
                }
        }

    }

    if($add){
        if(count($new_values)) {
            $to_add[$selector] = $new_values;
        } else {
            $to_add[$selector] = $values;
        }
    }
}

file_put_contents($argv[3], css_array_to_css($to_add));
