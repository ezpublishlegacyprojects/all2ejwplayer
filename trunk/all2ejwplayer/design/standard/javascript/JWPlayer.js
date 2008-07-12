JWPlayer = {
    idPrefix : "plb_",
    
    objPlayer : false,
    objOverlay : false,
    objBody : false,
    objHead : false,
    objPlayerBox : false,
    objSWF : false,
    objScript : false,
    arrPageSize : false,
    arrPageScroll : false,
    
    init : function(){
        this.arrPageSize = JWPlayer.getSize();
        this.arrPageScroll = JWPlayer.getScroll();
        
        this.objBody = document.getElementsByTagName("body").item(0);
        
        this.objPlayerBox = document.createElement("div");
        this.objPlayerBox.setAttribute("id", this.idPrefix);
        
        this.objOverlay = document.createElement("div");
        this.objOverlay.setAttribute("id", this.idPrefix+"overlay");
        this.objOverlay.style.height = this.arrPageSize[1]+"px";
        this.objOverlay.style.width = this.arrPageSize[0]+"px";
        this.objOverlay.onclick = function(){JWPlayer.stop(this)};
        
        this.objPlayer = document.createElement("div");
        this.objPlayer.setAttribute("id", this.idPrefix+"player");
        this.objPlayer.onclick = function(){JWPlayer.stop(this)};
        
        this.objPlayerBox.appendChild(this.objOverlay);
        this.objPlayerBox.appendChild(this.objPlayer);
        this.objBody.appendChild(this.objPlayerBox);
    },
    
    play : function(link,source,params){
        this.arrPageScroll = JWPlayer.getScroll();
        this.objPlayer.style.top = this.arrPageScroll[1]+((JWPlayer.getScreenHeight()-params.height)/2)+"px";
        this.objPlayerBox.style.display = "block";
        this.objSWF = new SWFObject(source,this.idPrefix+"mpl",params.width,params.height,"9",params.bgcolor);
        this.objSWF.addParam("allowscriptaccess","always");
        this.objSWF.addParam("allowfullscreen","true");
        this.objSWF.addParam("flashvars","&skin="+params.skin+"&file="+link+"&autostart="+params.autostart+"&fullscreen="+params.fullscreen);
        this.objSWF.write(this.idPrefix+"player");
    },
    
    stop : function(e){
    		if( e.id != this.idPrefix+"mpl"){
      			this.objSWF.addParam("flashvars","&file=");
            this.objSWF.write(this.idPrefix+"player");
            this.objPlayerBox.style.display = "none";
    		}
    },
    
    getScreenHeight : function(){
        if(self.innerHeight){var y = self.innerHeight;}
        else if(document.documentElement && document.documentElement.clientHeight){var y = document.documentElement.clientHeight;}
        else if(document.body){var y = document.body.clientHeight;}
        return y;
    },
    getSize : function(){
        var xScroll, yScroll;
        if (window.innerHeight && window.scrollMaxY) {
            xScroll = window.innerWidth + window.scrollMaxX;
            yScroll = window.innerHeight + window.scrollMaxY;
        } else if (document.body.scrollHeight > document.body.offsetHeight){ // all but Explorer Mac
            xScroll = document.body.scrollWidth;
            yScroll = document.body.scrollHeight;
        } else { // Explorer Mac...would also work in Explorer 6 Strict, Mozilla and Safari
            xScroll = document.body.offsetWidth;
            yScroll = document.body.offsetHeight;
        }
        var windowWidth, windowHeight;
        if (self.innerHeight) { // all except Explorer
            if(document.documentElement.clientWidth){
                windowWidth = document.documentElement.clientWidth;
            } else {
                windowWidth = self.innerWidth;
            }
            windowHeight = self.innerHeight;
        } else if (document.documentElement && document.documentElement.clientHeight) { // Explorer 6 Strict Mode
            windowWidth = document.documentElement.clientWidth;
            windowHeight = document.documentElement.clientHeight;
        } else if (document.body) { // other Explorers
            windowWidth = document.body.clientWidth;
            windowHeight = document.body.clientHeight;
        }
        if(yScroll < windowHeight){
            pageHeight = windowHeight;
        } else {
            pageHeight = yScroll;
        }
        if(xScroll < windowWidth){
            pageWidth = xScroll;
        } else {
            pageWidth = windowWidth;
        }
        arrayPageSize = new Array(pageWidth,pageHeight,windowWidth,windowHeight)
        return arrayPageSize;
    },
    
    getScroll : function(){
        var xScroll, yScroll;
        if (self.pageYOffset) {
            yScroll = self.pageYOffset;
            xScroll = self.pageXOffset;
        } else if (document.documentElement && document.documentElement.scrollTop){ // Explorer 6 Strict
            yScroll = document.documentElement.scrollTop;
            xScroll = document.documentElement.scrollLeft;
        } else if (document.body) {// all other Explorers
            yScroll = document.body.scrollTop;
            xScroll = document.body.scrollLeft;
        }
        arrayPageScroll = new Array(xScroll,yScroll)
        return arrayPageScroll;
    }
}

window.onload = function(){
    JWPlayer.init();
}
