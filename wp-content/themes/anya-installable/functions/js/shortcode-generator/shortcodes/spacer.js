desShortcodeMeta={
	attributes:[
		{
			label:"Height [Desktop]",
			id:"heightdesktop",
			help: 'The height of the Spacer (in pixels) in desktop mode.',
		},
		{
			label:"Height [Mobile]",
			id:"heightmobile",
			help: 'The height of the Spacer (in pixels) in mobile mode.'
		}
		],
		disablePreview:true,
		customMakeShortcode: function(b){
			var output = "[spacer desktop='"+b.heightdesktop+"' ";
			if (b.heightmobile)
				output += "mobile='"+b.heightmobile+"'";
				output += "]";
			return output;
		}
};
