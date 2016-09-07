desShortcodeMeta={
	attributes:[
		{
			label:"Style",
			id:"style",
			help: 'Heading Text Styles',
			controlType: "select-control",
			selectValues:['Main Section', 'Sub Section', 'Micro Section / Aside'],
			defaultValue: 'Main Section',
			defaultText: 'Main Section'
		}],
		customMakeShortcode: function(b){
			var a=b.data;
			return "[heading_text style='"+ b.style +"'] Your heading goes here. [/heading_text]";
		}
};
