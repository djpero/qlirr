 function calculateEndOffer(xtime, offset, type) {
      var msPerDay = 24 * 60 * 60 * 1000;
      var splitDate = xtime.split("-");
      var splitTime = splitDate[2].split(" ");
      var firstTime = new Date(splitDate[1]+"/"+splitTime[0]+"/"+splitDate[0]+" "+splitTime[1]);
      var now2 = +new Date();
      var now= new Date(now2);
     
      var secTime = now.getTime();

      var timeLeft=(firstTime-secTime);  

//      // --------- racunaj koliko je ostalo --------
//
      var e_hrsLeft = (timeLeft / msPerDay)*24;
      var hrsLeft = Math.floor(e_hrsLeft).toString();
      
      var e_minsLeft = (e_hrsLeft - hrsLeft)*60;
      var minsLeft = Math.floor(e_minsLeft).toString();

      var e_secsLeft = (e_minsLeft - minsLeft)*60;
      var secsLeft = Math.floor(e_secsLeft).toString();
      
      var zeroNum="0";

      if (hrsLeft.length===1) {
          hrsLeft=zeroNum+hrsLeft;
      }
      if (minsLeft.length===1) {
          minsLeft=zeroNum+minsLeft;
      }

      if (secsLeft.length===1) {
          secsLeft=zeroNum+secsLeft;
      }
      if (type==0) {
          var result= hrsLeft + " : " + minsLeft + " : " + secsLeft;
      } else {
          var result= hrsLeft + " : " + minsLeft + " : " + secsLeft;
      }
      
      return result;
}

function purifyNo(number) {
    var temp = number;
    
    temp=temp.split("(").join("");
    temp=temp.split(")").join("");
    temp=temp.split("-").join("");
    temp=temp.split(" ").join("");
    temp=temp.split("+").join("");
    temp=temp.split("*").join("");
    temp=temp.split(".").join("");
    
    if (temp.charAt(0)=='0') {
        temp=temp.substr(1);
    }
    return temp;
}

function rndNo(length) {
    var text = "";
    var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
    for( var i=0; i < length; i++ )
        text += possible.charAt(Math.floor(Math.random() * possible.length));
    return text;
    
}
