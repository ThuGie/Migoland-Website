
function renderSW(taddress, twidth, theight , sw1, sw2, sw3, sw4, sw5, sw6, sw7, sw8){

	document.write(' <object classid="clsid:166B1BCA-3F9C-11CF-8075-444553540000"');
	document.write(' codebase="http://download.macromedia.com/pub/shockwave/cabs/director/sw.cab#version=11,5,7,609"');
	document.write(' ID=chat width='+twidth+' height='+theight+'>');
	document.write(' <param name=src value="'+taddress+'">');
	document.write(' <param name="sw1" value="'+sw1+'">');
	document.write(' <param name="sw2" value="'+sw2+'">');
	document.write(' <param name="sw3" value="'+sw3+'">');
	document.write(' <param name="sw4" value="'+sw4+'">');
	document.write(' <param name="sw5" value="'+sw5+'">');
	document.write(' <param name="sw6" value="'+sw6+'">');
	document.write(' <param name="sw7" value="'+sw7+'">');
	document.write(' <param name="sw8" value="'+sw8+'">');
        document.write(' <param name="PlayerVersion" value="11">');
	document.write(' <param name=swRemote value="'+"swSaveEnabled='true' swVolume='true' swRestart='true' swPausePlay='true' swFastForward='true' swContextMenu='false' "+'">');
	document.write(' <param name=swStretchStyle value=none>');
	document.write(' <PARAM NAME=bgColor VALUE=#94d13e> <PARAM NAME=swStretchHAlign VALUE=Left> <PARAM NAME=swStretchVAlign VALUE=Top> <PARAM NAME=progress VALUE=FALSE> <PARAM NAME=logo VALUE=FALSE>');
	document.write(' <embed src="'+taddress+'" bgColor=#94d13e swStretchHAlign=Left progress=FALSE logo=FALSE swStretchVAlign=Top  width='+twidth+' height='+theight+' swRemote="swSaveEnabled='+"'true' swVolume='true' swRestart='true' swPausePlay='true' swFastForward='true' swContextMenu='false' "+'" swStretchStyle=none');
	document.write(' type="application/x-director" pluginspage="http://www.macromedia.com/shockwave/download/" sw1="'+sw1+'" sw2="'+sw2+'" sw3="'+sw3+'" sw4="'+sw4+'" sw5="'+sw5+'" sw6="'+sw6+'" sw7="'+sw7+'" sw8="'+sw8+'" PlayerVersion="11"></embed>');
	document.write(' </object>');
        parent.gameframeIsLoaded();
}

function openadmin(inaddress) {
	adminwindow = window.open(inaddress, "admin",'scrollbars=no,resizable=no,width=360,height=570');
	adminwindow.focus();
}