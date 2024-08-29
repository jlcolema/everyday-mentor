jQuery(document).ready(function ($) {  
	// Post formats
	$(function()
	{
		$("#video_metabox").hide();

	// post formats
		$('#post-format-0').click(function()
		{
			$("#video_metabox").hide();
		});
		$('#post-format-image').click(function()
		{
			$("#video_metabox").hide();
		});
		$('#post-format-video').click(function()
		{
			$("#video_metabox").show();
		});
		$('#post-format-gallery').click(function()
		{
			$("#video_metabox").hide();
		});
		$('#post-format-link').click(function()
		{
			$("#video_metabox").hide();
		});
		$('#post-format-audio').click(function()
		{
			$("#video_metabox").hide();
		});
		if ( $("#post-format-video").attr("checked") == "checked" )
		{
			$("#video_metabox").show();
		}

	});
	// End post formats
});