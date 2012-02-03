<?php
/**
 * TODO: Docs.
 * Editable content blocks in web pages.
 */
class Content_PageTool extends PageTool {
	private $_elements = null;

	public function main($api, $dom, $template) {
		$this->_elements = $dom["*[@data-editable]"];
		foreach ($this->_elements as $element) {
			$content = $api["Content"]->get(array("Name" => $element->id));
			switch($content["L_Content_Type"]) {
			case "Text":
			case "TextPlain":
			case "TextTitle":
			case "TextRich":
				if(!empty($content["Value"])) {
					$element->html = $content["Value"];
				}
				break;
			case "Image":
				if(!empty($content["Value"])) {
					$element->setAttribute("src", $content["Value"]);
				}
				break;
			default: 
				break;
			}
		}
	}
}
?>