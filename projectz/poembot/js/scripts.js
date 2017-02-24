var cmudict = 
	[
		{word:"DILLON",list:["D","IH1","L","AH0","N"]},	
	];
	
var rawInputArray;
var phraseArray = [];
var usedEndWordArray = [];

var lineLength = 8;
	
var debug = true;

$(document).ready(function(e){

	$("#poem-button").click(function(e){
		
		if($("#line-length").val()!="") lineLength =$("#line-length").val(); 
		rawInputArray = getCleanInput();
		phraseArray = getPhrases(rawInputArray,lineLength);
		var testCouplet = getCouplet(3);
		printPhrase(testCouplet[0]);
		printPhrase(testCouplet[1]);
	});
	
	$("#new-couplet").click(function(e){

		var testCouplet = getCouplet(3);
		printPhrase(testCouplet[0]);
		printPhrase(testCouplet[1]);
	});
	
	
	$.get('http://reachdillon.com/projects/flowbot/cmudict.txt', function(data) {
		var filedata = data;
		
		var lines = filedata.split('\n');
		var templine;
		
		for(var line = 0; line < lines.length; line++){
		  templine = lines[line].split(" "); 
		  var revlist = templine.slice(2,templine.length).reverse();
		  cmudict.push({word:templine[0],list: revlist});
		}
		
		var cmudictJSON = JSON.stringify(cmudict);
		
		printout("Dictionary Loaded...\n");
	});
	
	
});

function wasPhraseUsed(phrase){
	var searchEndWord = getLastWordOfPhrase(phrase);
	var currEndWord;
	for(var i=0;i<usedEndWordArray.length;i++){
		currEndWord=usedEndWordArray[i];
		if(searchEndWord == currEndWord){
			return true;
		}
	}
	return false;
}

function getCouplet(threshold){
	console.log("Smashing bits");
	var couplet = [];
	var r1,r2;
	var counter=0;
	
	for(var i=0;i<phraseArray.length;i++){
		for(var j=0;j<phraseArray.length;j++){
			
			r1 = i;
			r2 = j;
			
			if(doPhrasesRhyme(threshold,phraseArray[r1],phraseArray[r2])){
				if(!wasPhraseUsed(phraseArray[r1]) && !wasPhraseUsed(phraseArray[r2])){
					couplet.push(phraseArray[r1],phraseArray[r2]);
					break;
				}else{
					printout("Duplicate words: "+getLastWordOfPhrase(phraseArray[r1])+", "+getLastWordOfPhrase(phraseArray[r2]));
				}
			}else{
			}
		}
		//console.log(".");
	}
	usedEndWordArray.push( getLastWordOfPhrase(couplet[0]) );
	usedEndWordArray.push( getLastWordOfPhrase(couplet[1]) );
	//printout("done");
	return couplet;
}

function doPhrasesRhyme(threshold,phrase1,phrase2){
	var endword1,endword2,score,ar1,ar2;
	
	endword1 = getLastWordOfPhrase(phrase1);
	endword2 = getLastWordOfPhrase(phrase2);
	
	ar1 = endword1.split("");
	ar2 = endword2.split("");
	ar1.diff(ar2);
	if(endword1.length > 3 && endword2.length > 3 && ar1.length==1){
		printout("words 1 letter apart: "+endword1+" "+endword2);
		return false;
	}
	
	if(endword1 == endword2){
		//printout("words are same"+endword1);
		return false;
	}
	
	if(rhymeScore(endword1,endword2) >= threshold){
		return true;
	}else{
		return false;
	}
}

function printPhrase(phrase){
	var sentence="";
	for(var i=0;i<phrase.length;i++){
		if(i!=phrase.length-1){
			sentence += phrase[i]+" ";	
		}else{
			sentence += " - "+phrase[i]+" "+returnList(phrase[i]);
		}
	}
	printout(sentence);
}

function getLastWordOfPhrase(phrase){
	//printout("phrase: "+phrase);
	//printout("Last word of phrase: "+phrase[phrase.length-1]);
	return phrase[phrase.length-1];
}

function getCleanInput(){
	var input = $("#input").val().replace(/[\"'@1234567890.,-\/#!$?%\^&\*;:{}=\-_`~()\[\]]/g,"");
	input = input.replace(/\n/g," ");
	input = input.replace(/\s+/g,' ').trim();
	input = input.toLowerCase();
	$("#output").val(input);
	rawInputArray = input.split(" ");
	
	return rawInputArray;
	
	printout(rawInputArray);
}



//populates phrase array
function getPhrases(inputArr,lineLength){
	
	var tempPhrase = [];
	
	
	printout("Phrases of "+lineLength+" words");
	
	inputArr.unshift("SHIFTER-ELEMENT"); //offets the initial push
	for(var i=0; i < inputArr.length-lineLength; i++){
		for(var p=0;p<lineLength;p++){
			tempPhrase.push(inputArr[i+p]);	
		}
		phraseArray.push(tempPhrase);
		tempPhrase= [];
	}
	phraseArray.shift();						//removes the shifter element
	
	printout("Phrase Array Populated...\n");
	printout(phraseArray);
	return phraseArray;
}

function backupRhymeScore(word1,word2){
	return 0;
}

//Returns a number of how much 2 words rhyme based off of their syllable lists
function rhymeScore(word1,word2){
	var simSpree =0, simSpreeMax=0;
	var temp1,temp2;
	var firstSpree = true;
	
	list1 = returnList(word1);
	list2 = returnList(word2);

	//if the first word is longer
	if(list1.length > list2.length){
		for(var i=0;i<list2.length;i++){
			temp1 = list1[i];
			temp2 = list2[i];
			
			if(temp1 == temp2)
			{
				simSpree++ 
			}else{
				simSpree=0;
				firstSpree=false;
			}	//check if longest sim spree
			if(simSpree > simSpreeMax && firstSpree) simSpreeMax = simSpree;
		}
	// if the second word is longer
	}else{
		for(var i=0;i<list1.length;i++){
			temp1 = list1[i];
			temp2 = list2[i];
			if(temp1 == temp2){
				simSpree++;
			}else{
				simSpree=0;
				firstSpree=false;
			}	
			//check if longest sim spree
			if(simSpree > simSpreeMax && firstSpree) simSpreeMax = simSpree;	
		}
	}
	
	return simSpreeMax;
}

// Returns the list of syllables in a searchWord
function returnList(searchWord){
	searchWord = searchWord.toUpperCase();
	for(var i = 0; i < cmudict.length; i++)
	{
	  if(cmudict[i].word == searchWord)
	  {
		return cmudict[i].list;
	  }
	}
	return "NONE";
}

function printout(words){
	if(debug){
		console.log(words);
	}
}

function randomInt(min,max)
{
    return Math.floor(Math.random()*(max-min+1)+min);
}

Array.prototype.diff = function(a) {
    return this.filter(function(i) {return a.indexOf(i) < 0;});
};

