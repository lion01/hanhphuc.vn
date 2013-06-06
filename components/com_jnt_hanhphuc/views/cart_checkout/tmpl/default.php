<?php
/**
 * @version		$Id: default.php 21020 2011-03-27 06:52:01Z infograf768 $
 * @package		Joomla.Site
 * @subpackage	com_content
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT.DS.'helpers');

// Create shortcuts to some parameters.
?>


<div class="container">
    <div class="float-left left-side">
		<div class="sub-container list-services shopping-cart relative">
			<h2>Thông tin giỏ hàng</h2>
			
			<div>
		    	<?php
		    	$items = $this->order->items;
		    	if($items):
		    	?>
		    	<table class="gridtable" width="650">
		    		<thead>
		    			<tr>
			    			<th>Dịch vụ</th>
			    			<th>Doanh nghiệp cung cấp</th>
			    			<th width="50" nowrap="nowrap">Số lượng</th>
			    			<th width="120">Giá</th>
		    			</tr>
		    		</thead>
		    		<tbody>
			    	<?php foreach($items as $item): ?>
			    		<tr>
			    			<td><?php echo $item->name?></td>
			    			<td><?php echo $item->businessProfile->business_name?></td>
			    			<td class="txt-right"><?php echo $item->qty?></td>
			    			<td class="txt-right"><?php echo $item->current_price?></td>
			    		</tr>
			    	<?php endforeach;?>
		    		</tbody>
		    	</table>
		    	<?php else:?>
		    		<p>Bạn chưa có sản phẩm nào trong giỏ hàng</p>
		    	<?php endif;?>
		    </div>
		    <div>
		    	<?php if($this->order->price > 0):?>
		    		Tổng giá: <?php echo $this->order->price?>
		    	<?php endif;?>
		    </div>
		    
		    <div class="clr"></div>
		    
		    <div>
		    	<h3>Chọn hình thức thanh toán:</h3>
		    	<form action="<?php echo JRoute::_('index.php?option=com_jnt_hanhphuc&task=order.choicePayMethodSubmit')?>" method="post">
		    		<input type="hidden" name="option" value="com_jnt_hanhphuc"/>
		    		<input type="hidden" name="task" value="order.choicePayMethodSubmit"/>
		    		
		    		<input id="payment_method_1" type="radio" name="payment_method" value="1" />
		    		<label for="payment_method_1">Chuyển tiền qua bưu điện</label>
		    			
		    		<br/>
		    		<input id="payment_method_2" type="radio" name="payment_method" value="2" />
		    		<label for="payment_method_2">Thanh toán qua chuyển khoản</label>
		    		
		    		<br/>
		    		<input class="button" type="submit" value="Tiếp tục thanh toán"/>
		    	</form>
		    </div>
		</div>
	</div>
	<div class="float-right right-side">
		<?php echo JEUtil::loadModule('right', 'module-padding'); ?>
		
		<div class="module-title module-padding">THÔNG TIN KHUYẾN MẠI</div>
		<div class="line-break-promotion"><span></span></div>
		<div class="box">
			<ul class="news-other-list">
				<li>
					Áo cưới: ....
				</li>
			</ul>
		</div>
		
		<div class="module-title module-padding">DOANH NGHIỆP TIÊU BIỂU</div>
		<div class="line-break"></div>
		<div class="box">
			<ul>
				<li>
					<div class="img">
						img here
					</div>
					<div class="bussiness-focus-info">
						<p class="title">Áo cưới</p>
						<p class="address">Địa chỉ</p>
						<p class="phone">Điện thoại</p>
					</div>
				</li>
			</ul>
		</div>
    </div>
</div>

<div class="clr"></div>
