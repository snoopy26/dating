<?php
	
	class Pagination_tmpl {

		function getPaginationString($page = 1, $totalItems, $limit = 15, $adjacents = 1, $targetPage = '/', $pageString = '?page='){
			if (!$adjacents) $adjacents = 1;
			if (!$limit) $limit = 15;
			if (!$page) $page = 1;
			if (!$targetPage) $targetPage = '/';
			$prev = $page - 1;
			$next = $page + 1;
			$lastPage = ceil($totalItems / $limit);
			$lpm1 = $lastPage - 1;
			$pagination = '';
			if ($lastPage > 1){
				$pagination .= '<div class="pagination" style="margin:20px 0;" >';
				
				if ($page > 1){
					$pagination .= '<a href="'.$targetPage.$pageString.$prev.'">&laquo; prev</a>';
				}else{
					$pagination .= '<span class="disabled">&laquo; prev</span>';
				}
				
				if ($lastPage < 7 + ($adjacents * 2)){
					for($counter = 1; $counter <= $lastPage; $counter++){
						if ($counter == $page){
							$pagination .= '<span class="current">'.$counter.'</span>';
						}else{
							$pagination .= '<a href="'.$targetPage.$pageString.$counter.'">'.$counter.'</a>';
						}
					}
				}else if($lastPage >= 7 + ($adjacents * 2)){
					if ($page < 1 + ($adjacents * 3)){
						for($counter = 1; $counter < 4 + ($adjacents * 2); $counter++){
							if ($counter == $page){
								$pagination .= '<span class="current">'.$counter.'</span>';
							}else{
								$pagination .= '<a href="'.$targetPage.$pageString.$counter.'">'.$counter.'</a>';
							}
						}
						$pagination .= '<span class="elipses">...</span>';
						$pagination .= '<a href="'.$targetPage.$pageString.$lpm1.'">'.$lpm1.'</a>';
						$pagination .= '<a href="'.$targetPage.$pageString.$lastPage.'">'.$lastPage.'</a>';
					}else if ($lastPage - ($adjacents * 2) > $page && $page > ($adjacents * 2)){
						$pagination .= '<a href="'.$targetPage.$pageString.'1">1</a>';
						$pagination .= '<a href="'.$targetPage.$pageString.'2">2</a>';
						$pagination .= '<span class="elipses">...</span>';
						for($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++){
							if ($counter == $page){
								$pagination .= '<span class="current">'.$counter.'</span>';
							}else{
								$pagination .= '<a href="'.$targetPage.$pageString.$counter.'">'.$counter.'</a>';
							}
						}
						$pagination .= '<span class="elipses">...</span>';
						$pagination .= '<a href="'.$targetPage.$pageString.$lpm1.'">'.$lpm1.'</a>';
						$pagination .= '<a href="'.$targetPage.$pageString.$lastPage.'">'.$lastPage.'</a>';
					}else{
						$pagination .= '<a href="'.$targetPage.$pageString.'1">1</a>';
						$pagination .= '<a href="'.$targetPage.$pageString.'2">2</a>';
						$pagination .= '<span class="elipses">...</span>';
						for($counter = $lastPage - (1 + ($adjacents * 3)); $counter <= $lastPage; $counter++){
							if ($counter == $page){
								$pagination .= '<span class="current">'.$counter.'</span>';
							}else{
								$pagination .= '<a href="'.$targetPage.$pageString.$counter.'">'.$counter.'</a>';
							}
						}
					}
				}
				
				if ($page < $counter - 1){
					$pagination .= '<a href="'.$targetPage.$pageString.$next.'">next &raquo;</a>';
				}else{
					$pagination .= '<span class="disabled">next &raquo;</span>';
				}
				
				$pagination .= '</div><br />';
				
			}
			
			return $pagination;
			
		}
		
	}

	

?>