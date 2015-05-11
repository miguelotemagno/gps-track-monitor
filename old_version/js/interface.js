/***************************/
//@Author: Adrian "yEnS" Mato Gondelle
//@website: www.yensdesign.com
//@email: yensamg@gmail.com
//@license: Feel free to use it, but keep this credits please!					
/***************************/

//global vars
var file_status = 0;
var tools_status = 0;
var help_status = 0;
var lateralPanel_status = 1;


//events
$(document).ready(function(){
	/********** CONFIGURE PATTERN ************/
    var windowHeight = document.documentElement.clientHeight;
    var menuHeight = document.getElementById("menu").clientHeight;
	
    if(navigator.appName == "Microsoft Internet Explorer"){
        $("body").css("max-height",windowHeight-menuHeight);
		$("#lateralClick").css("height",windowHeight-menuHeight);
		$("#lateralPanel").css("height",windowHeight-menuHeight);
		$("#mainContent").css("height",windowHeight-menuHeight);
    }
    else{
		$("body").css("max-height",windowHeight-menuHeight);
        $("#lateralClick").css("height",windowHeight-menuHeight);
		$("#lateralPanel").css("height",windowHeight-menuHeight);
		$("#mainContent").css("height",windowHeight-menuHeight);
    }
	//for resize of the window, recalculate the max-height available
	window.onresize = function(){
		windowHeight = document.documentElement.clientHeight;
		menuHeight = document.getElementById("menu").clientHeight;
		$("body").css("max-height",windowHeight-menuHeight);
		$("#lateralClick").css("height",windowHeight-menuHeight);
		$("#lateralPanel").css("height",windowHeight-menuHeight);
		$("#mainContent").css("height",windowHeight-menuHeight);
	};
    
	/********** TOP MENU ************/
    //CLICK FILE MENU
    $("#file").click(function(){
        //HIDE OTHERS
            //tools
            toolsHide();
            //help
            helpHide();
        //SHOW
        if(file_status == 0){
            //SHOW FILE SUBMENU
            fileShow();
        }
        //HIDE
        else{
            //HIDE FILE SUBMENU
            fileHide();
        }
    });
    //CLICK TOOLS MENU
    $("#tools").click(function(){
        //HIDE OTHERS
            //file
            fileHide();
            //help
            helpHide();
        if(tools_status == 0){
            //SHOW TOOLS SUBMENU
            toolsShow();
        }
        else{
            //HIDE TOOLS SUBMENU
            toolsHide();
        }
    });
    //CLICK HELP MENU
    $("#help").click(function(){
        //HIDE OTHERS
            //file
            fileHide();
            //tools
            toolsHide();
        if(help_status == 0){
            //SHOW HELP SUBMENU
            ayudaShow();
        }
        else{
            //HIDE HELP SUBMENU
            helpHide();
        }
    });
    //CLICK REFRESH
    $("#recargar").click(function(){
        //REFRESH WEB
        location.href="";
    });
    //HOVER FILE MENU
    $("#file").mouseover(function(){
        fileOn();
        toolsOff();
        helpOff();
        if(tools_status == 1 || help_status == 1){
            fileShow();
            helpHide();
            toolsHide();
        }
    });
    //HOVER TOOLS MENU
    $("#tools").mouseover(function(){
        toolsOn();
        fileOff();
        helpOff();
        if(file_status == 1 || help_status == 1){
            fileHide();
            helpHide();
            toolsShow();
        }
    });
    //HOVER HELP MENU
    $("#help").mouseover(function(){
        helpOn();
        fileOff();
        toolsOff();
        if(file_status == 1 || tools_status == 1){
            fileHide();
            toolsHide();
            ayudaShow();
        }
    });
    //MOUSE OUT FILE MENU
    $("#file").mouseout(function(){
        if(file_status == 0){
            fileOff();
        }
    });
    //MOUSE OUT TOOLS MENU
    $("#tools").mouseout(function(){
        if(tools_status == 0){
            toolsOff();
        }
    });
    //MOUSE OUT HELP MENU
    $("#help").mouseout(function(){
        if(help_status == 0){
            helpOff();
        }
    });
	//CLICK NEW (file submenu)
	$("#new").click(function(){
		alert("selected: new");
	});
	//CLICK OPEN (file submenu)
	$("#open").click(function(){
		alert("selected: open");
	});
	//CLICK SAVE (file submenu)
	$("#save").click(function(){
		alert("selected: save");
	});
	//CLICK PRINT (tools submenu)
	$("#print").click(function(){
		print();
	});
    //CLICK BODY
    $("div:not(#menu)").click(function(){
        fileHide();
        toolsHide();
        helpHide();
    });
    //PRESS ESCAPE
    $(document).keyup(function(event){
        fileHide();
        toolsHide();
        helpHide();
    });
	/********** LATERAL PANEL ************/
    //CLICK LATERALCLICK
    $("#lateralClick").click(function(){
        if(lateralPanel_status == 0){
            //MOSTRAMOS LATERALPANEL
            lateralPanelShow();
        }
        else{
            //OCULTAMOS LATERALPANEL
            lateralPanelHide();
        }
    });
	
	//CLICK SECTION TITLE (toggle)
	$(".section").click(function(){
		$("#" + $(this).attr("id") + " + ul").slideToggle("slow");
	});
	//CLICK SITE TO CHANGE SRC PROPERTY OF THE IFRAME
	$("#lateralPanel li").click(function(){
		$("#iframe").attr("src",$(this).text()+".php");
		//Thanks Shawn user from jquery google groups for the tip! (old code was a little bit complex than his solution :P)
		$("#lateralPanel li").removeClass("active");
		$(this).addClass("active");
	});
});


//FUNCTIONS
//TOP MENU
function fileOn(){
    $("#file").css("background","url(../images/menu_li_bg.gif)");
}
function fileOff(){
    $("#file").css("background-image","none");
}
function fileHide(){
    fileOff();
    $("#fileContainer").css("display","none");
    file_status = 0;
}
function fileShow(){
    fileOn();
    $("#fileContainer").css("display","block");
    file_status = 1;
}
function toolsOn(){
    $("#tools").css("background","url(../images/menu_li_bg.gif)");
}
function toolsOff(){
    $("#tools").css("background-image","none");
}
function toolsShow(){
    toolsOn();
    $("#toolsContainer").css("display","block");
    tools_status = 1;
}
function toolsHide(){
    toolsOff();
    $("#toolsContainer").css("display","none");
    tools_status = 0;
}
function helpOn(){
    $("#help").css("background","url(../images/menu_li_bg.gif)");
}
function helpOff(){
    $("#help").css("background-image","none");
}
function ayudaShow(){
    helpOn();
    $("#helpContainer").css("display","block");
    help_status = 1;
}
function helpHide(){
    helpOff();
    $("#helpContainer").css("display","none");
    help_status = 0;
}
//LATERAL PANEL
function lateralPanelShow(){
	$("#lateralClickImg").attr("src","../images/toggleRight.gif");
	$("#lateralPanel").show();
    lateralPanel_status = 1;
}
function lateralPanelHide(){
	$("#lateralClickImg").attr("src","../images/toggleLeft.gif");
    $("#lateralPanel").hide();
    lateralPanel_status = 0;
}