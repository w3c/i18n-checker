<?php if (Message::$messages && count(Message::$messages) > 0) { ?>
	<div id="messages">
		<?php foreach (Message::$messages as $message) { ?>
		<div class="<?php echo $message->type ?>">
			<h4><?php echo $message->message ?></h4>
		</div>
		<?php } ?>
	</div>
<?php } ?>