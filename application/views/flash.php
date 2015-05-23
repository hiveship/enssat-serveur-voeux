<?php
$levels = array ( 
	
		'error', 
		'warning', 
		'success', 
		'info' 
);
<div id="flash" class="container">
<% [:error, :warning, :success, :info].each do |level|
if flash[level] %>
<%= content_tag :div, class: %(alert alert-#{level} fade in) do %>
<%= button_tag 'x', type: 'button', class: 'close', data: {dismiss: 'alert'} %>
<%= flash[level] %>
<% end
end
end %>
</div>