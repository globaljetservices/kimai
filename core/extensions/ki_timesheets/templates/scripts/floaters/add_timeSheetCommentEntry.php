<script type="text/javascript">

$(document).ready(function() {
    $('#help').hide();
//return;
    $('#ts_ext_form_add_timeSheetCommentEntry').ajaxForm( {
        'beforeSubmit' :function() {
            clearFloaterErrorMessages();


            if ($('#ts_ext_form_add_timeSheetCommentEntry').attr('submitting')) {
                return false;
            }
            else {
                $('#ts_ext_form_add_timeSheetCommentEntry').attr('submitting', true);
                return true;
            }


        },
        'success' : function(result) {
            $('#ts_ext_form_add_timeSheetCommentEntry').removeAttr('submitting');
            for (var fieldName in result.errors)
                setFloaterErrorMessage(fieldName,result.errors[fieldName]);

            if (result.errors.length == 0) {
                floaterClose();
                ts_ext_reload();
            }
        },

        'error' : function() {
            $('#ts_ext_form_add_timeSheetCommentEntry').removeAttr('submitting');
        }
    });

    $('#floater_innerwrap').tabs({ selected: 0 });

});
// document ready

</script>


<div id="floater_innerwrap">

<div id="floater_handle">
    <span id="floater_title"><?php if (isset($this->id)) echo $this->kga['lang']['edit']; else echo $this->kga['lang']['add']; ?></span>
    <div class="right">
        <a href="#" class="close" onClick="floaterClose();"><?php echo $this->kga['lang']['close']?></a>
        <a href="#" class="help" onClick="$(this).blur(); $('#help').slideToggle();"><?php echo $this->kga['lang']['help']?></a>
    </div>
</div>

<div id="help">
    <div class="content">
        <?php echo $this->kga['lang']['dateAndTimeHelp']?>
    </div>
</div>

<div class="menuBackground">

    <ul class="menu tabSelection">
        <li class="tab norm"><a href="#extended">
                <span class="aa">&nbsp;</span>
                <span class="bb"><?php echo $this->kga['lang']['advanced']?></span>
                <span class="cc">&nbsp;</span>
            </a></li>
    </ul>
</div>

<form id="ts_ext_form_add_timeSheetCommentEntry" action="../extensions/ki_timesheets/processor.php" method="post">
    <input name="id" type="hidden" value="<?php echo $this->id?>" />
    <input name="axAction" type="hidden" value="add_timeSheetCommentEntry" />

    <div id="floater_tabs" class="floater_content">
        <fieldset id="extended">

            <ul>

                <li>
                    <label for="comment"><?php echo $this->kga['lang']['comment']?>:</label>
                    <textarea id='comment' style="width:395px" class='comment' name='comment' cols='40' rows='5' tabindex='13'><?php echo $this->escape($this->comment)?></textarea>
                </li>

                <li>
                    <label for="commentType"><?php echo $this->kga['lang']['commentType']?>:</label>
                    <?php echo $this->formSelect('commentType', $this->commentType, array(
                        'id' => 'commentType',
                        'class' => 'formfield',
                        'tabindex' => '14'), $this->commentTypes); ?>
                </li>

            </ul>

        </fieldset>


    </div>

    <div id="formbuttons">
        <input class='btn_norm' type='button' value='<?php echo $this->kga['lang']['cancel']?>' onClick='floaterClose(); return false;' />
        <input class='btn_ok' type='submit' value='<?php echo $this->kga['lang']['submit']?>' />
    </div>


</form>

</div>
