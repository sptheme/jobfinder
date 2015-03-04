/**
 * job Short code button
 */

( function() {
     tinymce.create( 'tinymce.plugins.job', {
        init : function( ed, url ) {
             ed.addButton( 'job', {
                title : 'Insert Job',
                image : url + '/ed-icons/job.png',
                onclick : function() {
						var width = jQuery( window ).width(), H = jQuery( window ).height(), W = ( 720 < width ) ? 720 : width;
						W = W - 80;
						H = H - 84;
						tb_show( 'Job Options', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=sc-job-form' );
                 }
             });
         },
         createControl : function( n, cm ) {
             return null;
         },
     });
	tinymce.PluginManager.add( 'job', tinymce.plugins.job );
	jQuery( function() {
		var form = jQuery( '<div id="sc-job-form"><table id="sc-job-table" class="form-table">\
							<tr>\
							<th><label for="sc-job-number">Number of job</label></th>\
							<td><input type="text" name="sc-job-number" id="sc-job-number" value="-1" /></td>\
							</tr>\
							</table>\
							<p class="submit">\
							<input type="button" id="sc-job-submit" class="button-primary" value="Insert job" name="submit" />\
							</p>\
							</div>' );
		var table = form.find( 'table' );
		form.appendTo( 'body' ).hide();
		form.find( '#sc-job-submit' ).click( function() {
			var job_number = table.find( '#sc-job-number' ).val(),
			shortcode = '[job post_num="' + job_number + '"]';
				
			tinyMCE.activeEditor.execCommand( 'mceInsertContent', 0, shortcode );
			tb_remove();
		} );
	} );
 } )();