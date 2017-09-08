<script>
function compare(a,b) 
{
  if (a.created > b.created)
    return -1;
  if (a.created < b.created)
    return 1;
  return 0;
}

var limit = 5;
var last_permlink = '';


function showPage(author,limit)
{
	var today = new Date();
	var today_str = today.format('yyyy-mm-dd') + 'T' + today.format('HH:MM:ss');
	console.log("start_last_permlink",window.last_permlink);
	steem.api.getDiscussionsByAuthorBeforeDate(author,window.last_permlink,today_str,limit, function(err, result) {
    	//console.log(err, result);
    	var arrArticles = new Array();
    	for(var i=0;i<result.length;i++)
    	{
    		arrArticles[arrArticles.length] = result[i];
    	}
    	arrArticles.sort(compare);

    	var i = 0;
    	if(limit == window.limit + 1)i++;	//n+1로 들어올 경우 받아온 자료 중 0번째 자료는 지난 번의 마지막 자료다.
    	for(i;i<arrArticles.length;i++)
    	{
    		//이 부분에서 글 하나하나를 html로 뿌려준다.
    	}
    	window.last_permlink = arrArticles[arrArticles.length-1].permlink;
    	console.log("last_permlink",window.last_permlink);	//마지막 permlink를 전역변수에 저장
 	});
}

function getMorePage(author)
{
	$('#more_button').attr('disabled','true'); 	// More (더보기) 버튼 클릭시 : 자료를 받고 나서 다시 활성화 시킨다.
	var limit = window.limit+1;					// 마지막 permlink를 포함하여 자료를 받아오기 떄문에 갯수는 n+1이 된다.
	showPage(author,limit);
}

function getFirstPage(author)
{
	$('#more_button').attr('disabled','true');	// More (더보기) 버튼 클릭시 : 자료를 받고 나서 다시 활성화 시킨다.
	var limit = window.limit;					// 처음 n개의 자료를 가져옴/
	window.last_permlink = "";
	$('#aritcles_body').html('');
	showPage(author,limit);
}
</script>