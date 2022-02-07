function ajaxreg(reginfo) {
    var ac=reginfo['account'];
    var psd=reginfo['password'];
    var psdre=reginfo['password_repeat'];
    var email=reginfo['email'];
    var returndata="wait ajax";
    if(ac.length<4){
        return "accountlength1";
    }else if(ac.length>15){
        return "accountlength2";
    }else if(psd.length<4||psd.length>15){
        return "psdlength";
    }else if(psd!=psdre){
        return "repeaterror";
    }else if(!checkEmail(email)){
        return "emailerror";
    }else{
        jQuery.ajax({
            type: "post",
            url: "http://localhost/dbdesign/blog_acpsdreg.php",
            async:false,
            data: {
                account:ac,
                password:psd,
                email:email
            },
            dataType: 'text',
            success: function(data) {
                console.log("ajax success");
                console.log("���ص�dataΪ"+data);
                if(data=="accountbusy"){
                    console.log("�û���ռ��");
                    returndata= "accountbusy";
                }else if(data=="dberror"){
                    console.log("���ݿ����");
                    returndata= "dberror";
                } else{
                    console.log("ע��ɹ�");
                    returndata= "regsuccess";
                }
            },
            error: function(jqXHR) {
                console.log("error");
                console.log(jqXHR);
                returndata= "dberror";
            },
        });
        return returndata;
    }

}

function ajaxlogin(logininfo) {
    var ac=logininfo['account'];
    var psd=logininfo['password'];
    var returndata="wait ajax";
    jQuery.ajax({
        type: "post",
        url: "http://localhost/dbdesign/blog_acpsdlog.php",
        async:false,
        data: {
            account:ac,
            password:psd
        },
        dataType: 'text',
        success: function(data) {
            console.log("ajax success");
            console.log("���ص�dataΪ"+data);
            if(data=="noaccount"){
                console.log("�û���������");
                returndata= "noaccount";
            }else if(data=="dberror"){
                console.log("���ݿ����");
                returndata= "dberror";
            }else if(data=="passwordfalse"){
                console.log("�û������������");
                returndata="passwordfalse";
            } else if(data=="logsuccess"){
                console.log("��¼�ɹ�");
                returndata= "logsuccess";
            }else{
                console.log("δ֪����");
                returndata= "dberror";
            }
        },
        error: function(jqXHR) {
            console.log("error");
            console.log(jqXHR);
            returndata= "dberror";
        },
    });
    return returndata;
}

function checkEmail(email){
    var myReg=/^[a-zA-Z0-9_-]+@([a-zA-Z0-9]+\.)+(com|cn|net|org)$/;

    if(myReg.test(email)){
        return true;
    }else{
        return false;
    }
}

function ajaxsendblog(bloginfo) {
    var returndata="wait ajax";
    jQuery.ajax({
        type: "post",
        url: "http://localhost/dbdesign/blog_sendblog.php",
        async:false,
        data: bloginfo,
        dataType: 'text',
        success: function(data) {
            console.log("ajax success");
            console.log("sendblog���ص�dataΪ"+data);
            if(data=="sendsuccess"){
                console.log("ajax.js�ķ���ֵ:sendsuccess");
                returndata="sendsuccess";
            }else {
                returndata="senderror";
            }
        },
        error: function(jqXHR) {
            console.log("error");
            console.log(jqXHR);
            returndata="senderror";
        },
    });
    return returndata;
    
}

function ajaxgetblog(limit) {
    var returndata={};
    jQuery.ajax({
        type: "post",
        url: "http://localhost/dbdesign/blog_getblog.php",
        async:false,
        data: {
            "limit":limit
        },
        dataType: 'json',
        success: function(data) {
            console.log("ajax success");
            console.log("ajaxgetblog���ص�dataΪ"+data);
            returndata=data;
        },
        error: function(jqXHR) {
            console.log("error");
            console.log(jqXHR);
            returndata={};
        },
    });
    return returndata;
}

function ajaxgetuser(info) {
    // console.log("ajaxgetblogbyaccount ing");
    var returndata={};
    jQuery.ajax({
        type: "post",
        url: "http://localhost/dbdesign/blog_getblogbyaccount.php",
        async:false,
        data: {
            "limit":info['limit'],
            "account":info['account']
        },
        dataType: 'json',
        success: function(data) {
            // console.log("ajax success");
            // console.log("blog_getblogbyaccount���ص�dataΪ"+data);
            returndata=data;
        },
        error: function(jqXHR) {
            console.log("error");
            console.log(jqXHR);
            returndata={};
        },
    });
    return returndata;
}

function ajaxgetstyle(info) {
    var returndata={};
    jQuery.ajax({
        type: "post",
        url: "http://localhost/dbdesign/blog_getblogbystyle.php",
        async:false,
        data: {
            "limit":info['limit'],
            "style":info['style']
        },
        dataType: 'json',
        success: function(data) {
            // console.log("ajax success");
            // console.log("blog_getblogbystyle���ص�dataΪ"+data);
            returndata=data;
        },
        error: function(jqXHR) {
            console.log("error");
            console.log(jqXHR);
            returndata={};
        },
    });
    return returndata;

}

function ajaxdeletenews(newsid) {
    var returndata='delete error';
    jQuery.ajax({
        type: "post",
        url: "http://localhost/dbdesign/blog_deletenews.php",
        async:false,
        data: {
            'newsid':newsid
        },
        dataType: 'text',
        success: function(data) {
            // console.log("ajax success");
            // console.log("blog_getblogbystyle���ص�dataΪ"+data);
            returndata=data;
        },
        error: function(jqXHR) {
            console.log("error");
            console.log(jqXHR);
            returndata='delete error';
        },
    });
    return returndata;
}

function ajaxgetblogvague(keywords){
    var returndata={};
    jQuery.ajax({
        type: "post",
        url: "http://localhost/dbdesign/blog_getblogvague.php",
        async:false,
        data: {
            'keywords':keywords
        },
        dataType: 'json',
        success: function(data) {
            // console.log("ajax success");
            // console.log("blog_getblogvague���ص�dataΪ"+data);
            returndata=data;
        },
        error: function(jqXHR) {
            console.log("error");
            console.log(jqXHR);
            returndata={};
        },
    });
    return returndata;
}

function ajaxgetzannum(newsid){
    var returndata='get error';
    jQuery.ajax({
        type: "post",
        url: "http://localhost/dbdesign/blog_getzannum.php",
        async:false,
        data: {
            'newsid':newsid
        },
        dataType: 'text',
        success: function(data) {
            // console.log("ajax success");
            // console.log("blog_getzannum���ص�dataΪ"+data);
            returndata=data;
        },
        error: function(jqXHR) {
            console.log("error");
            console.log(jqXHR);
            returndata='get error';
        },
    });
    return returndata;
}

function ajaxgetifzan(account,newsid){
    var returndata='get error';
    jQuery.ajax({
        type: "post",
        url: "http://localhost/dbdesign/blog_getifzan.php",
        async:false,
        data: {
            'account':account,
            'newsid':newsid
        },
        dataType: 'text',
        success: function(data) {
            // console.log("ajax success");
            // console.log("blog_getifzan���ص�dataΪ"+data);
            returndata=data;
        },
        error: function(jqXHR) {
            console.log("error");
            console.log(jqXHR);
            returndata='get error';
        },
    });
    return returndata;
}

function ajaxaddzan(account,newsid){
    var returndata='get error';
    jQuery.ajax({
        type: "post",
        url: "http://localhost/dbdesign/blog_addzan.php",
        async:false,
        data: {
            'account':account,
            'newsid':newsid
        },
        dataType: 'text',
        success: function(data) {
            // console.log("ajax success");
            // console.log("blog_addzan���ص�dataΪ"+data);
            returndata=data;
        },
        error: function(jqXHR) {
            console.log("error");
            console.log(jqXHR);
            returndata='get error';
        },
    });
    return returndata;
}

function ajaxdeletezan(account,newsid){
    var returndata='get error';
    jQuery.ajax({
        type: "post",
        url: "http://localhost/dbdesign/blog_deletezan.php",
        async:false,
        data: {
            'account':account,
            'newsid':newsid
        },
        dataType: 'text',
        success: function(data) {
            // console.log("ajax success");
            // console.log("blog_removezan���ص�dataΪ"+data);
            returndata=data;
        },
        error: function(jqXHR) {
            console.log("error");
            console.log(jqXHR);
            returndata='get error';
        },
    });
    return returndata;
}

function ajaxgetbloghot(){
    var returndata={};
    jQuery.ajax({
        type: "post",
        url: "http://localhost/dbdesign/blog_getbloghot.php",
        async:false,
        data: {
        },
        dataType: 'json',
        success: function(data) {
            // console.log("ajax success");
            // console.log("blog_gethot���ص�dataΪ"+data);
            returndata=data;
        },
        error: function(jqXHR) {
            console.log("error");
            console.log(jqXHR);
            returndata={};
        },
    });
    return returndata;
}

function ajaxgetblogtui(account){
    var returndata={};
    jQuery.ajax({
        type: "post",
        url: "http://localhost/dbdesign/blog_getblogtui.php",
        async:false,
        data: {
            'account':account
        },
        dataType: 'json',
        success: function(data) {
            // console.log("ajax success");
            // console.log("blog_gettui���ص�dataΪ"+data);
            returndata=data;
        },
        error: function(jqXHR) {
            console.log("error");
            console.log(jqXHR);
            returndata={};
        },
    });
    return returndata;
}

function ajaxgetuserfayannum(account){
    var returndata={};
    jQuery.ajax({
        type: "post",
        url: "http://localhost/dbdesign/blog_getuserfayannum.php",
        async:false,
        data: {
            'account':account
        },
        dataType: 'json',
        success: function(data) {
            console.log("ajax success");
            console.log("blog_getfayan���ص�dataΪ"+data);
            returndata=data;
        },
        error: function(jqXHR) {
            console.log("������ajax error");
            console.log(jqXHR);
            returndata={};
        },
    });
    return returndata;
}

function ajaxgetuserzannum(account){
    var returndata;
    jQuery.ajax({
        type: "post",
        url: "http://localhost/dbdesign/blog_getuserzannum.php",
        async:false,
        data: {
            'account':account
        },
        dataType: 'json',
        success: function(data) {
            console.log("ajax success");
            console.log("blog_getzan���ص�dataΪ"+data);
            returndata=data;
        },
        error: function(jqXHR) {
            console.log("������ajax error");
            console.log(jqXHR);
            returndata={};
        },
    });
    return returndata;
}

function ajaxgetuserimgs(account){
    var returndata={};
    jQuery.ajax({
        type: "post",
        url: "http://localhost/dbdesign/blog_getuserimgs.php",
        async:false,
        data: {
            'account':account
        },
        dataType: 'json',
        success: function(data) {
            console.log("ajax success");
            console.log("blog_getimgs���ص�dataΪ"+data);
            returndata=data;
        },
        error: function(jqXHR) {
            console.log("error");
            console.log(jqXHR);
            returndata={};
        },
    });
    return returndata;
}

function ajaxgetlastupdatetime(account){
    var returndata={};
    jQuery.ajax({
        type: "post",
        url: "http://localhost/dbdesign/blog_getlastupdatetime.php",
        async:false,
        data: {
            'account':account
        },
        dataType: 'json',
        success: function(data) {
            console.log("ajax success");
            console.log("blog_getimgs���ص�dataΪ"+data);
            returndata=data;
        },
        error: function(jqXHR) {
            console.log("error");
            console.log(jqXHR);
            returndata={};
        },
    });
    return returndata;
}

function ajaxgetlastlogintime(account){
    var returndata={};
    jQuery.ajax({
        type: "post",
        url: "http://localhost/dbdesign/blog_getlastlogintime.php",
        async:false,
        data: {
            'account':account
        },
        dataType: 'json',
        success: function(data) {
            console.log("ajax success");
            console.log("blog_getimgs���ص�dataΪ"+data);
            returndata=data;
        },
        error: function(jqXHR) {
            console.log("error");
            console.log(jqXHR);
            returndata={};
        },
    });
    return returndata;
}

function ajaxvisit(visitor,user){
    var returndata={};
    jQuery.ajax({
        type: "post",
        url: "http://localhost/dbdesign/blog_visit.php",
        async:false,
        data: {
            'visitor':visitor,
            'user':user
        },
        dataType: 'text',
        success: function(data) {
            console.log("ajax success");
            console.log("blog_visit���ص�dataΪ"+data);
            returndata=data;
        },
        error: function(jqXHR) {
            console.log("error");
            console.log(jqXHR);
            returndata={};
        },
    });
    return returndata;
}

function ajaxgetvisitor(account){
    var returndata={};
    jQuery.ajax({
        type: "post",
        url: "http://localhost/dbdesign/blog_getvisitor.php",
        async:false,
        data: {
            'account':account
        },
        dataType: 'json',
        success: function(data) {
            console.log("ajax success");
            console.log("blog_getvisitor���ص�dataΪ"+data['blogs'][0]);
            returndata=data;
        },
        error: function(jqXHR) {
            console.log("error");
            console.log(jqXHR);
            returndata={};
        },
    });
    return returndata;
}

function ajaxgetattention(attentor,user){
    var returndata={};
    jQuery.ajax({
        type: "post",
        url: "http://localhost/dbdesign/blog_getattention.php",
        async:false,
        data: {
            'attentor':attentor,
            'user':user
        },
        dataType: 'text',
        success: function(data) {
            console.log("ajax success");
            console.log("blog_attention���ص�dataΪ"+data);
            returndata=data;
        },
        error: function(jqXHR) {
            console.log("error");
            console.log(jqXHR);
            returndata={};
        },
    });
    return returndata;
}

function ajaxtoggleattention(attentor,user){
    var returndata={};
    jQuery.ajax({
        type: "post",
        url: "http://localhost/dbdesign/blog_toggleattention.php",
        async:false,
        data: {
            'attentor':attentor,
            'user':user,
        },
        dataType: 'text',
        success: function(data) {
            console.log("ajax success");
            console.log("blog_toggleattention���ص�dataΪ"+data);
            returndata=data;
        },
        error: function(jqXHR) {
            console.log("error");
            console.log(jqXHR);
            returndata={};
        },
    });
    return returndata;
}

function ajaxgetblogguanzhu(account){
    var returndata={};
    jQuery.ajax({
        type: "post",
        url: "http://localhost/dbdesign/blog_getblogguanzhu.php",
        async:false,
        data: {
            'account':account
        },
        dataType: 'json',
        success: function(data) {
            // console.log("ajax success");
            // console.log("blog_gethot���ص�dataΪ"+data);
            returndata=data;
        },
        error: function(jqXHR) {
            console.log("error");
            console.log(jqXHR);
            returndata={};
        },
    });
    return returndata;
}

function ajaxgetguanzhuuser(account){
    var returndata={};
    jQuery.ajax({
        type: "post",
        url: "http://localhost/dbdesign/blog_getguanzhuuser.php",
        async:false,
        data: {
            'account':account
        },
        dataType: 'json',
        success: function(data) {
            returndata=data;
        },
        error: function(jqXHR) {
            console.log("error");
            console.log(jqXHR);
            returndata={};
        },
    });
    return returndata;
}

function ajaxgetcomments(newsid) {
    var returndata={};
    jQuery.ajax({
        type: "post",
        url: "http://localhost/dbdesign/blog_getcomments.php",
        async:false,
        data: {
            'newsid':newsid
        },
        dataType: 'json',
        success: function(data) {
            returndata=data;
        },
        error: function(jqXHR) {
            console.log("error");
            console.log(jqXHR);
            returndata={};
        },
    });
    return returndata;
}

function sendcommit(a,newsid){
    var delcomment='<span class="iconfont icon-delete" style="font-size: 0.3em;float: right;margin-top: 0px" onclick="delcomment(this)"></span>';
    var commitinput=a.previousElementSibling;
    // console.log("���������Ϊ��"+commitinput.value);
    // console.log("��newsid:"+newsid+"��΢������");
    var commitcontent=a.parentNode.previousElementSibling.childNodes[0];
    var account=localStorage.getItem('account');
    commitcontent.innerHTML=commitcontent.innerHTML+'<a class="title"  style="color: #5fa3d2" >'+account+':</a>'+ delcomment+'&nbsp;&nbsp;&nbsp;'+commitinput.value;

    var returndata={};
    jQuery.ajax({
        type: "post",
        url: "http://localhost/dbdesign/blog_sendcommit.php",
        async:false,
        data: {
            'account':account,
            'newsid':newsid,
            'content':commitinput.value
        },
        dataType: 'text',
        success: function(data) {
            returndata=data;
        },
        error: function(jqXHR) {
            console.log("error");
            console.log(jqXHR);
            returndata={};
        },
    });
    return returndata;

}

function delcomment(delbtn) {
    var commentid=delbtn.id;
    var p=delbtn.parentElement.parentElement;
    var returndata={};
    console.log("ɾ��"+commentid);
    jQuery.ajax({
        type: "post",
        url: "http://localhost/dbdesign/blog_delcomment.php",
        async:false,
        data: {
            'id':commentid
        },
        dataType: 'text',
        success: function(data) {
            returndata=data;
        },
        error: function(jqXHR) {
            console.log("error");
            console.log(jqXHR);
            returndata={};
        },
    });
    console.log(returndata);
    p.removeChild(delbtn.parentElement);
    return returndata;
}

function sendmessage(){
    var receiver=document.getElementById('receiver').value;
    var content=document.getElementById('messagecontent').value;

    var returndata={};



    var messagehtml='<div class="message-content" style="margin-bottom: 5px;min-height: 65px;max-height: 65px;overflow: auto;padding: 10px">\n' +
        '            <div style="float: left" ><span style="color: #7dc9e2;font-family: ΢���ź�;font-size: 0.75em">TO:'+receiver+'     <br>'+content+'</span><span style="color: #7dc9e2;font-family: ΢���ź�;font-size: 0.75em"><br>'+'</span></div>\n' +
        '            <div style="vertical-align: middle;float: right">\n' +
        '                <i class="iconfont icon-xinxi" style="margin-right: 10px;font-size: 22px;color: #7dc9e2;vertical-align: middle"></i>\n' +
        '            </div>\n' +
        '        </div>';
    var contetns=document.getElementsByClassName('messages-content');
    contetns[0].innerHTML=messagehtml+contetns[0].innerHTML
    jQuery.ajax({
        type: "post",
        url: "http://localhost/dbdesign/blog_sendmessage.php",
        async:false,
        data: {
            'sender':localStorage.getItem('account'),
            'receiver':receiver,
            'content':content
        },
        dataType: 'text',
        success: function(data) {
            returndata=data;
        },
        error: function(jqXHR) {
            console.log("error");
            console.log(jqXHR);
            returndata={};
        },
    });
    if(returndata=="no receiver"){
        mui.alert("�û�������","��ʾ","ȷ��");
    }else if(returndata=="message false"){
        mui.alert("����ʧ��","��ʾ","ȷ��");
    }else {
        mui.alert("���ͳɹ�","��ʾ","ȷ��");
        document.getElementById('receiver').innerHTML="";
        document.getElementById('messagecontent').innerHTML="";
    }
    return returndata;
}

function getmessage(){
    var messagecontent=document.getElementsByClassName('messages-content');
    messagecontent=messagecontent[0];
    var returndata={};
    jQuery.ajax({
        type: "post",
        url: "http://localhost/dbdesign/blog_getmessage.php",
        async:false,
        data: {
            'account':localStorage.getItem('account'),
        },
        dataType: 'json',
        success: function(data) {
            returndata=data;
        },
        error: function(jqXHR) {
            console.log("error");
            console.log(jqXHR);
            returndata={};
        },
    });
    var messages=returndata['blogs'];
    var messagehtml="";
    for(var i=0;i<messages.length;i++){
        var send_id=messages[i][1];
        if(send_id==localStorage.getItem('account')){
            var sendto=messages[i][2];
            console.log("�� �� ���Լ�");
            messagehtml+='<div class="message-content" style="margin-bottom: 5px;min-height: 65px;max-height: 65px;overflow: auto;padding: 10px">\n' +
                '            <div style="float: left" ><span style="color: #7dc9e2;font-family: ΢���ź�;font-size: 0.75em">TO:'+sendto+'     '+messages[i][4]+'</span><span style="color: #7dc9e2;font-family: ΢���ź�;font-size: 0.75em"><br>'+messages[i][3]+'</span></div>\n' +
                '            <div style="vertical-align: middle;float: right">\n' +
                '                <i class="iconfont icon-xinxi" style="margin-right: 10px;font-size: 22px;color: #7dc9e2;vertical-align: middle"></i>\n' +
                '            </div>\n' +
                '        </div>';
        }else{
            messagehtml+='<div class="message-content" style="margin-bottom: 5px;min-height: 65px;max-height: 65px;overflow: auto;padding: 10px">\n' +
                '            <div style="float: left" ><span style="color: black;font-family: ΢���ź�;font-size: 0.75em">'+messages[i][1]+':     '+messages[i][4]+'</span><span style="color: #6d6d6d;font-family: ΢���ź�;font-size: 0.75em"><br>'+messages[i][3]+'</span></div>\n' +
                '            <div style="vertical-align: middle;float: right">\n' +
                '                <i class="iconfont icon-xinxi" style="margin-right: 10px;font-size: 22px;color: #7dc9e2;vertical-align: middle" onclick="chat(\''+send_id+'\')"></i>\n' +
                '            </div>\n' +
                '        </div>';
        }
    }
    messagecontent.innerHTML=messagehtml;
    return returndata;
}

function chat(id){
    document.getElementById('receiver').value=id;
}

function ajaxgetuserfennum(account){
    var returndata={};
    jQuery.ajax({
        type: "post",
        url: "http://localhost/dbdesign/blog_getuserfennum.php",
        async:false,
        data: {
            'account':account
        },
        dataType: 'text',
        success: function(data) {
            returndata=data;
        },
        error: function(jqXHR) {
            console.log("error");
            console.log(jqXHR);
            returndata={};
        },
    });
    return returndata;

}

test=function () {
    console.log("test2222222");
}

//