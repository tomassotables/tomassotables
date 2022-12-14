<div class="wrap">
    <div id="icon-themes" class="icon32"></div>  
    <h2>Sync product stock</h2>  
    <?php if(isset($msg)){ ?>
    	<div id="message" class="fade updated notice is-dismissible"><p><?php echo ($msg === true)?'Products stock Sync startet sucessfully ':'Something went wrong!'; ?></p><button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span></button></div>
    <?php }
    ?>
    	<h2>Start stocks sync with vince manager</h2> 
        <input type="button"  id="btnSubmit" value="Start" class="button button-primary" name="ipb_settings_save"> 
    
        <p id="resp" style="display:none;"></p>
		        
</div>