desShortcodeMeta={
	attributes:[
		{
			label:"Title",
			id:"title",
/* 			isRequired:true */
		},
		{
			label:"Font Size",
			id:"title_size",
			help:"The size of the icon. You can either use <i>px</i> or <i>em</i> unities. Ex #1: <i>12px</i> | Ex #2: <i>3em</i>"
		},
		{
			label:"Font Color",
			id:"title_color",
			controlType:"colourpicker-control",
			help:"Values: &lt;empty&gt; for default or a color (e.g. Yellow or #ffffff)."
		},
		{
			label:"Background Color",
			id:"bg_color",
			controlType:"colourpicker-control",
			help:"Values: &lt;empty&gt; for default or a color (e.g. Yellow or #ffffff)."
		},
		{
			label:"Title Align",
			id:"title_align",
			controlType:"select-control", 
			selectValues:['left', 'center', 'right'],
			defaultValue: 'Left',
			defaultText: 'Left'
		},
		{
			label:"Top Margin [Desktop]",
			id:"heightdesktop",
			help: 'The margin-top of the Title (in pixels) in desktop mode.',
		},
		{
			label:"Top Margin [Mobile]",
			id:"heightmobile",
			help: 'The margin-top of the Tiyle (in pixels) in mobile mode.'
		},
		{
			label:"Bottom Margin [Desktop]",
			id:"bottomheightdesktop",
			help: 'The margin-bottom of the Title (in pixels) in desktop mode.',
		},
		{
			label:"Bottom Margin [Mobile]",
			id:"bottomheightmobile",
			help: 'The margin-bottom of the Title (in pixels) in mobile mode.'
		}
		],
		disablePreview: true,
		customMakeShortcode: function(b){
		
			var a=b.data;
			
			var style = "";
			
			if(b.title_color != '')
				style += "color='" +b.title_color+ "' ";
			
			if(b.title_size != '')
				style += "font_size='" +b.title_size+ "' ";
			
			if(b.bg_color != '')
				style += "background='" +b.bg_color+ "' ";
			
			if(b.title_align != '')
				style += "text_align='" +b.title_align+ "' ";
			
			var output, bottomoutput = "";
			
			if (b.heightdesktop){
				var output = "[spacer desktop='"+b.heightdesktop+"' ";
				if (b.heightmobile)
					output += "mobile='"+b.heightmobile+"'";
					output += "]";				
			}
			
			if (b.bottomheightdesktop){
				var bottomoutput = "[spacer desktop='"+b.bottomheightdesktop+"' ";
				if (b.heightmobile)
					bottomoutput += "mobile='"+b.bottomheightmobile+"'";
					bottomoutput += "]";				
			}
			
			g = "[anyatitle title='"+b.title+"' ";
			if (style!="") g+= style;
			g += "]";
			return output+g+bottomoutput;
		
		}
};