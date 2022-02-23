<?php
if (isset($categories)) {
	if (!empty($categories)) {
		foreach ($categories as $key => $value) {
			if ($value->status == 0) {
				$status = '<a href="javascript:void(0)" id="' . $value->food_category_id . '" class="change-p-status text-danger" data-status="1" data-table="food_categories" data-key-id="food_category_id" data-id="' . $value->food_category_id . '">Inactive</a>';
			} else if ($value->status == 1) {
				$status = '<a href="javascript:void(0)" id="' . $value->food_category_id . '" class="change-p-status text-success" data-status="0" data-table="food_categories" data-key-id="food_category_id" data-id="' . $value->food_category_id . '">Active</a>';
			}
			$html .= '<tr>
						<td>' . ($key+1) . '</td>
						<td><span>' . $value->category_name . '</span></td>
						<td><span>' . $value->parent_category_name . '</span></td>
                    	<td>' . $status . '</td>
						<td>
							<a class="edit_class btn btn-gray" href="'.base_url("admin/food/category/edit/".$value->food_category_id).'"><i class="fa fa-edit ml-2"></i></a>
                    		<a href="javascript:void(0)" class="btn btn-gray change-p-status" data-fnc="getOperationAreaList" data-status="3" data-f="del" data-table="food_categories" data-key-id="food_category_id" data-id="' . $value->food_category_id . '"><i class="fa fa-trash"></i></a>
                    	</td>
                    </tr>';
		}
	}else{
		$html .='<tr>
				<td colspan="4" align="center">
					No data found
				</td>
			</tr>';
	}
	echo $html;
} //end food_categories

if (isset($items)) {
	if (!empty($items)) {
		foreach ($items as $key => $value) {
			if ($value->status == 0) {
				$status = '<a href="javascript:void(0)" id="' . $value->food_item_id  . '" class="change-p-status text-danger" data-status="1" data-table="food_items" data-key-id="food_item_id " data-id="' . $value->food_item_id  . '">Inactive</a>';
			} else if ($value->status == 1) {
				$status = '<a href="javascript:void(0)" id="' . $value->food_item_id  . '" class="change-p-status text-success" data-status="0" data-table="food_items" data-key-id="food_item_id " data-id="' . $value->food_item_id  . '">Active</a>';
			}
			$html .= '<tr>
						<td>' . ($key+1) . '</td>
						<td><span>' . $value->item_name . '</span></td>
						<td><span>' . $value->category_name . '</span></td>
						<td><span>' . $value->description . '</span></td>
                    	<td>' . $status . '</td>
						<td>
							<a class="edit_class btn btn-gray" href="'.base_url("admin/food/items/edit/".$value->food_item_id ).'"><i class="fa fa-edit ml-2"></i></a>
                    		<a href="javascript:void(0)" class="btn btn-gray change-p-status" data-fnc="getOperationAreaList" data-status="3" data-f="del" data-table="food_items" data-key-id="food_item_id " data-id="' . $value->food_item_id  . '"><i class="fa fa-trash"></i></a>
                    	</td>
                    </tr>';
		}
	}else{
		$html .='<tr>
				<td colspan="4" align="center">
					No data found
				</td>
			</tr>';
	}
	echo $html;
} //end food_categories
if (isset($addons)) {
	if (!empty($addons)) {
		foreach ($addons as $key => $value) {
			if ($value->addon_status == 0) {
				$status = '<a href="javascript:void(0)" id="' . $value->food_item_addon_id  . '" class="change-p-status text-danger" data-status="1" data-table="food_item_addons" data-key-id="food_item_addon_id " data-id="' . $value->food_item_addon_id  . '">Inactive</a>';
			} else if ($value->addon_status == 1) {
				$status = '<a href="javascript:void(0)" id="' . $value->food_item_addon_id  . '" class="change-p-status text-success" data-status="0" data-table="food_item_addons" data-key-id="food_item_addon_id " data-id="' . $value->food_item_addon_id  . '">Active</a>';
			}
			$html .= '<tr>
						<td>' . ($key+1) . '</td>
						<td><span>' . $value->item_name . '</span></td>
						<td><span>' . $value->addon_name . '</span></td>
						<td><span>' . $value->addon_price . '</span></td>
                    	<td>' . $status . '</td>
						<td>
							<a class="edit_class btn btn-gray" href="'.base_url("admin/food/addon/edit/".$value->food_item_addon_id ).'"><i class="fa fa-edit ml-2"></i></a>
                    		<a href="javascript:void(0)" class="btn btn-gray change-p-status" data-status="3" data-f="del" data-table="food_item_addons" data-key-id="food_item_addon_id " data-id="' . $value->food_item_addon_id  . '"><i class="fa fa-trash"></i></a>
                    	</td>
                    </tr>';
		}
	}else{
		$html .='<tr>
				<td colspan="4" align="center">
					No data found
				</td>
			</tr>';
	}
	echo $html;
} //end items addons

if (isset($coupons)) {
	if (!empty($coupons)) {
		foreach ($coupons as $key => $value) {
			if ($value->status == 0) {
				$status = '<a href="javascript:void(0)" id="' . $value->food_coupon_id  . '" class="change-p-status text-danger" data-status="1" data-table="food_coupons" data-key-id="food_coupon_id " data-id="' . $value->food_coupon_id  . '">Inactive</a>';
			} else if ($value->status == 1) {
				$status = '<a href="javascript:void(0)" id="' . $value->food_coupon_id  . '" class="change-p-status text-success" data-status="0" data-table="food_coupons" data-key-id="food_coupon_id " data-id="' . $value->food_coupon_id  . '">Active</a>';
			}

			$html .= '<tr>
						<td>' . ($key+1) . '</td>
						<td><span>' . $value->coupon_code . '</span></td>
						<td><span>' . d_format($value->start_date) . '</span></td>
						<td><span>' . d_format($value->end_date) . '</span></td>
						<td><span>' . round($value->min_purchase_amount, 2) . '</span></td>
						<td><span>' . round($value->discount_amount, 2) . '</span></td>
						<td><span>' . $value->max_uses . '</span></td>
						<td><span>' . ($value->coupon_type==2?"Percentage":"Flat") . '</span></td>
                    	<td>' . $status . '</td>
						<td>
							<a class="edit_class btn btn-gray" href="'.base_url("admin/food/coupon/edit/".$value->food_coupon_id ).'"><i class="fa fa-edit ml-2"></i></a>
                    		<a href="javascript:void(0)" class="btn btn-gray change-p-status" data-status="3" data-f="del" data-table="food_coupons" data-key-id="food_coupon_id " data-id="' . $value->food_coupon_id  . '"><i class="fa fa-trash"></i></a>
                    	</td>
                    </tr>';
		}
	}else{
		$html .='<tr>
				<td colspan="4" align="center">
					No data found
				</td>
			</tr>';
	}
	echo $html;
} //end items coupons
if (isset($orders)) {
	$html = '';
	if (!empty($orders)) {
		foreach ($orders as $key => $value) {
			if ($value->status == 0) {
				$status = '<a href="javascript:void(0)" id="" class="text-danger">Inactive</a>';
			} else if ($value->status == 1) {
				$status = '<a href="javascript:void(0)" id="" class="text-success">Active</a>';
			}
			// $o_s = '1';
			// if(!empty($value->order_status)){
				$o_s = $value->food_order_status_id;
			//}
			$html .= '<tr>
						<td>' . $value->food_order_id . '</td>
						<td><span>' . $value->first_name.' '.$value->last_name . '</span></td>
						<td><span>' . d_format($value->order_date, true) . '</span></td>
						<td><span>' . round($value->payable_amount, 2) . '</span></td>
						<td><select class="food-order-status">
						';
						$d = 'disabled';
						foreach ($order_status as $k => $v) {
							$st = '';
							if($o_s == $v->food_order_status_id){
								$st =  'selected';
							}
							$html .= '<option xx="'.$o_s.'" '.$d.' value="'.$v->food_order_status_id.'" '.$st.' data-id="'.$value->food_order_id.'">'.$v->food_order_status.'</option>';
							
							if($o_s == $v->food_order_status_id){
								$d = '';
							}else{
								$d = 'disabled';
							}
						}
						
			$html .='</select><td>
						<a class="btn btn-gray" href="'.base_url("admin/food/orders/".$value->food_order_id ).'"><i class="fa fa-eye text text-success" aria-hidden="true"></i></a>
							<a href="javascript:void(0)" class="btn btn-gray change-p-status" data-status="3" data-f="del" data-table="food_orders" data-key-id="food_order_id " data-id="' . $value->food_order_id  . '"><i class="fa fa-trash"></i></a>
                    	</td>
                    </tr>';
		}
	}else{
		$html .='<tr>
				<td colspan="5" align="center">
					No data found
				</td>
			</tr>';
	}
	echo $html;
} //end orders