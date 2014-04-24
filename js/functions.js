function convertRating(rating){
    switch(rating)
    {
    case 100:
	return "+"
	break;
    case 50:
	return "/"
	break;
    case 0:
	return "-"
	break;
    }
}

function parsePrompt(data){
    var html = "<div class='reviewItem'>";
    console.log(data);
    html += convertRating(data.rating) + " ";
    html += "<a class='profilelink' href='/profile?profileid="+data.userid+"'>" + data.username + "</a><br>";
    
    html += data.prompt
	.replace("{{input}}", "<span style='display: inline; color:red;'>"+data.input+"</span>")
	.replace("{{restaurant}}", "<a style='display: inline;' href='/items?restaurantid="+ data.restaurantid +"'>"+data.restaurant+"</a>")
	.replace("{{dish}}", "<a style='display: inline;' href='/vote?restaurantid="+data.restaurantid+"&itemid="+data.itemid+"&restaurantname="+data.restaurant+"&itemname="+data.item+"'>"+data.item+"</a>")
	.replace("{{input2}}", "<span type='text' name='input2' style='display: inline; color: red;'>"+data.input2+"</span>");

    html += "</div><br>";

    return html;
}

function parseVotePrompt(data){
    //takes the prompt and returns an html string
    var html = "" + data.prompt;
    html = html.replace("{{input}}", "<input type='text' name='input' style='display: inline;'>");
    html = html.replace("{{input2}}", "<input type='text' name='input2' style='display: inline;'>");
    html = html.replace("{{restaurant}}", "<span style='color: red;'><?=$restaurantName?></span>");
    html = html.replace("{{dish}}", "<span style='color: red;'><?=$itemName?></span>");
    html = html + "<input type='hidden' name='promptid' value='"+data.promptid+"'/>";

    return html;
}
