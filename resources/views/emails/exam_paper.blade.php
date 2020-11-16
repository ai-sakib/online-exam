<div marginwidth="0" marginheight="0">
    <table width="615" align="center" border="0" cellspacing="0" cellpadding="0" style="color:#3d4249;font-size:12px;line-height:24px" class="m_-5010887829332876555main">
        <tbody>
          <tr valign="top">
            <td>
                <table border="0" cellspacing="0" cellpadding="0" align="center">
                    
                    <tbody>
                      <tr valign="top" style="height:100px">
                        <td style="text-align:center;background:#162035;padding-top:30px;padding-bottom:30px;padding-left:30px;padding-right:30px">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                              <tbody><tr>
                                <td align="left"><a href="{{ url('/') }}" target="_blank"><img align="left" src="{{ url('public/images/logo.png') }}" alt="Online Exam" width="160" height="37" class="CToWUd"></a></td>
                                <td align="right" style="letter-spacing:3px;color:#cbcbcb">Online Exam</td>
                              </tr>
                            </tbody></table>                        
                          </td>
                        </tr>
                    
                    
                    <tr valign="top">
                        <td style="padding:5px 30px;text-align:center;background:#fff;font-size:18px">
                            <table class="m_-5010887829332876555full" width="640" align="center" border="0" cellspacing="0" cellpadding="0">
                                <tbody><tr>
                                  <td align="left" style="text-align:left;margin:60px 0 0px">
                                    <p style="margin-bottom:10px;margin-top:30px">Dear <strong>{{ $to_user->name }}</strong> Sir,</p>
                                    <p style="margin-bottom:20px">I have given the exam in online. Here is my exam sheet information</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td valign="top" align="left" style="padding:20px 0"> 
                                      <p style="margin-bottom:60px">
                                        <strong>Name: </strong>{{ $from_user->name }}<br>
                                        <strong>ID: </strong>{{ $from_user->id }}<br>
                                        <strong>Email: </strong>{{ $from_user->email }}<br><br>

                                        <strong>Subject: </strong>{{ $exam_subject}},&nbsp;
                                        <strong>Exam Paper No: </strong>{{ $exam_paper_id}},&nbsp;
                                        <strong>Set No: </strong>{{ $set_no}}<br><br>

                                        <strong>Answers:-</strong><br>
                                        @php $count = 0; @endphp
                                        @foreach($answers as $key => $answer)
                                          @php $count++; @endphp
                                            <span style="font-size: 15px;"><strong>Q. {{ $count }}</strong> ({{ options()[$answer] }})</span><br>
                                        @endforeach
                                      </p>
                                    </td>
                              	</tr>
                                <tr>
                                    <td align="left" style="text-align:left">
                                        <p>Thanks,</p>
                                        <p style="color:#050505;margin-bottom:50px"><strong>{{ $from_user->name }}</strong></p>                                  
                                      </td>
                              </tr>
                          </tbody></table>                      
                        </td>
                    </tr>
          
                    <tr valign="top">
                      <td style="background-color:#f2f3f8;padding:35px 30px 10px;text-align:center">
                            <table width="100%" align="center" border="0" cellspacing="0" cellpadding="0">
                            	<tbody>
                                <tr>
                                  <td align="right" style="text-align:center;border-bottom:1px solid #d8d8d8">
                                        
                                <p style="color:#727370;font-size:11px;text-align:center">
                                            This email was sent to you by Online Exam.
                                              <br>
                                          You are receiving this email because you signed up for Online Exam.</p>                                    </td>
                                </tr>
                                <tr>
                                  <td align="right" style="text-align:center;padding-top:10px"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                      <tbody><tr>
                                        <td align="left" style="color:#3555df;font-size:11px">
                                          
                                                <a href="#m_-5010887829332876555_" style="color:#3555df;text-decoration:none">Privacy Policy</a> |
                                                <a href="#m_-5010887829332876555_" style="color:#3555df;text-decoration:none">Help &amp; Support</a>                                        </td>
                                        <td style="color:#727370;font-size:11px" align="right">
	                                        Copyrights @2020-2021 | All Rights Reserved                                        </td>
                                      </tr>
                                  </tbody></table></td>
                                </tr>
                            </tbody></table>                      </td>
                    </tr>
                    
                  </tbody>
                </table>          
              </td>
            </tr>
        </tbody>
      </table>
      <div class="yj6qo"></div>
      <div class="adL">
    
      </div>
  </div>
