<?php

namespace feeduciary;

use feeduciary\Advisor;
use Illuminate\Database\Eloquent\Model;

class Pages extends Model
{
	public static $per_page = 10;
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
		return ($this->current_page - 1) * self::$per_page;
	}

	public function total_pages() {
		return ceil($this->total_count/self::$per_page);
	}

	public function previous_page() {
		return $this->current_page - 1;
	}

	public function next_page() {
		return $this->current_page + 1;
	}

	public function has_previous_page() {
		return $this->previous_page() >= 1 ? true : false;
	}

	public function has_next_page() {
		return $this->next_page() <= $this->total_pages() ? true : false;
	}

	public function pageLinks() {
		$answer = "";
		$previous = "";
		$next = "";
		if($this->total_pages() > 1) {
			$previous = '&laquo; Previous'; 
			if($this->has_previous_page()) { 
				$previous = "<a href='" . url('/advisors/page/') . $this->previous_page() . "'>{$previous}</a>";
			}
			for($i=1; $i <= $this->total_pages(); $i++) {
				if($i == $this->current_page) {
					$answer .= "<li><span class=\"selected\">{$i}</span></li> ";
				} else {
					$answer .= "<li><a href=\"/advisors/page/{$i}\">{$i}</a></li> "; 
				}
			}
			$next = "Next &raquo;";
			if($this->has_next_page()) { 
				$next = "<a href='" . url('/advisors/page/') . $this->next_page() . "'>{$next}</a>";
			}
		}
		return $previous . "<ul>" . $answer . "</ul>" . $next;
	}


}
