<?php

namespace feeduciary;

use feeduciary\Advisor;
use Illuminate\Database\Eloquent\Model;

class Pages extends Model
{
	public $per_page = 10;
  	public $current_page;
	public $total_count;

	public function __construct($displayCount, $page=1) {
		$this->current_page = (int)$page;
		$this->total_count = $displayCount;
	}

	public function offset() {
		// Assuming 20 items per page:
		// page 1 has an offset of 0    (1-1) * 20
		// page 2 has an offset of 20   (2-1) * 20
		//   in other words, page 2 starts with item 21
		return ($this->current_page - 1) * $this->per_page;
	}

	public function totalPages() {
		return ceil($this->total_count/$this->per_page);
	}

	public function previousPage() {
		return $this->current_page - 1;
	}

	public function nextPage() {
		return $this->current_page + 1;
	}

	public function hasPreviousPage() {
		return $this->previousPage() >= 1 ? true : false;
	}

	public function hasNextPage() {
		return $this->nextPage() <= $this->totalPages() ? true : false;
	}

	public function pageLinks() {
		$answer = "";
		$previous = "";
		$next = "";
		if($this->totalPages() > 1) {
			$previous = '&laquo; Previous'; 
			if($this->hasPreviousPage()) { 
				$previous = "<a href='" . url("/advisors/page/{$this->previousPage()}") . "'>{$previous}</a>";
			}
			for($i=1; $i <= $this->totalPages(); $i++) {
				if($i == $this->current_page) {
					$answer .= "<li><span class=\"selected\">{$i}</span></li> ";
				} else {
					$answer .= "<li><a href=\"/advisors/page/{$i}\">{$i}</a></li> "; 
				}
			}
			$next = "Next &raquo;";
			if($this->hasNextPage()) { 
				$next = "<a href='" . url("/advisors/page/{$this->nextPage()}") . "'>{$next}</a>";
			}
		}
		return "<ul><li>{$previous}</li>{$answer}<li>{$next}</li></ul>";
	}

}