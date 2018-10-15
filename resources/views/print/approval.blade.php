@if( isset($signature['direksi'] ))
    
    @if( isset($signature['dept'] ))
    <td style="width: 20%;">
        <br/><p>&nbsp;</p>
        <div align="center">                    
            <u>{{ $approval->histories->where("user_id",$signature['dept'])->first()->user->user_name }}</u> </br>
            <span>{{ $approval->histories->where("user_id",$signature['dept'])->first()->user->jabatan( $pt->id )->name }}</span>     
        </div>                                      
    </td> 
    @elseif ( isset($signature['div']) )
    <td style="width: 20%;">
        <br/><p>&nbsp;</p>
        <div align="center">                    
            <u>{{ $approval->histories->where("user_id",$signature['div'])->first()->user->user_name }}</u> </br>
            <span>{{ $approval->histories->where("user_id",$signature['div'])->first()->user->jabatan( $pt->id )->name }}</span>     
        </div>                                      
    </td>
    @endif

    @if( isset($signature['gm']  ))
    <td style="width: 20%;">
        <br/><p>&nbsp;</p>
        <div align="center">                    
            <u>{{ $approval->histories->where("user_id",$signature['gm'])->first()->user->user_name }}</u> </br>
            <span>{{ $approval->histories->where("user_id",$signature['gm'])->first()->user->jabatan( $pt->id )->name }}</span>     
        </div>                                      
    </td>  
    @endif

    @if( $approval->histories->where("user_id",$signature['user_id'])->count() > 0 )
    <td style="width: 20%;">
        <br/><p>&nbsp;</p>
        <div align="center">                    
            <u>{{ $approval->histories->where("user_id",$signature['user_id'])->first()->user->user_name }}</u> </br>
            <span>{{ $approval->histories->where("user_id",$signature['user_id'])->first()->user->jabatan( $pt->id )->name }}</span>     
        </div>                                      
    </td>   
    @endif
@else

     @if( isset( $signature['div'] ))
    <td style="width: 20%;">
        <br/><p>&nbsp;</p>
        <div align="center">                    
            <u>{{ $approval->histories->where("user_id",$signature['div'])->first()->user->user_name }}</u> </br>
            <span>{{ $approval->histories->where("user_id",$signature['div'])->first()->user->jabatan( $pt->id )->name }}</span>     
        </div>                                      
    </td> 
    @else
    <td style="width: 20%;">
        <br/><p>&nbsp;</p>
        <div align="center">                    
            <u>.............</u> </br>
            <span>Div. Head</span>     
        </div>                                      
    </td>
    @endif

    @if( isset($signature['dept']))
    <td style="width: 20%;">
        <br/><p>&nbsp;</p>
        <div align="center">                    
            <u>{{ $approval->histories->where("user_id",$signature['dept'])->first()->user->user_name }}</u> </br>
            <span>{{ $approval->histories->where("user_id",$signature['dept'])->first()->user->jabatan( $pt->id )->name }}</span>     
        </div>                                      
    </td> 
    @else
    <td style="width: 20%;">
        <br/><p>&nbsp;</p>
        <div align="center">                    
             <u>.............</u> </br>
            <span>Dept. Head</span>     
        </div>                                      
    </td>
    @endif

    @if( isset($signature['gm'] ))
    <td style="width: 20%;">
        <br/><p>&nbsp;</p>
        <div align="center">                    
            <u>{{ $approval->histories->where("user_id",$signature['gm'])->first()->user->user_name }}</u> </br>
            <span>{{ $approval->histories->where("user_id",$signature['gm'])->first()->user->jabatan( $pt->id )->name }}</span>     
        </div>                                      
    </td>  
    @else
    <td style="width: 20%;">
        <br/><p>&nbsp;</p>
        <div align="center">                    
             <u>{{ $gm or '' }}</u> </br>
            <span>General Manager</span>     
        </div>                                      
    </td>
    @endif
@endif

