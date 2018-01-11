@extends('sides')

@section('center-content')
  <div class="main-content">
    <div class="top-logos">
      @if($league_table)
        @foreach($league_table as $league_team)
          @if( !is_null($league_team->small_logo))
          <a href="{{ URL::to('team/'.$league_team->team_id )}}">
            <img src="{{asset($league_team->small_logo)}}">
          </a>
          @endif
        @endforeach
      @endif
    </div>
     
    <div class="posts"> 
      @if(isset($posts[0]))
      <div class="main-post">  
        <div class ="main-post-img">
                
          <a href="{{ URL::to('news/'.$posts[0]->id)}}">
            <img src ="{{ asset($posts[0]->main_img) }}" alt = 'news-foto'>
          </a>
          <div class='date'>
              {{ $posts[0]->created_at }}
          </div> 
               
        </div>
 
        @for( $i = 0; $i<(count($posts)); $i++)
        <div class="title"  data-img="{{ asset($posts[$i]->main_img) }}" data-href="{{ URL::to('news/'.$posts[$i]->id)}}" data-date="{{ $posts[$i]->created_at }}">
         <a  href="{{ URL::to('news/'.$posts[$i]->id)}}"><h4><b>{!! $posts[$i]->title !!}</b></h4></a>
         <h5>{!! $posts[$i]->subtitle !!}</h5>
        </div>
        @endfor
      </div>
      <div class="news-link">
        <a  href="{{ URL::to('news')}}">всі новини <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
      </div>
       @endif
    </div>
    

    <div class="league-table">
      @if($league)
        <div class ="table-title">
          <div class="bg title-top"></div>
          <div class="bg title-bottom"></div>
          <h5>{{$league->league_name.' '.$league->season }}</h5>
        </div>
        <table>
          <thead>
            <tr>
              <th>#</th>
              <th colspan="2">Команда</th>
              <th>I</th>
              <th>В</th>
              <th>Н</th>
              <th>П</th>
              <th>Зб.</th>
              <th>Пр.</th>
              <th>Рз.</th>
              <th>О</th>
            </tr>
          </thead>
          <tbody>
            @foreach($league_table as $key => $league_team)
            <tr>
              <td>{{$key+1}}</td>
              <td width="20"><img src="{{ $league_team->small_logo or ' ' }}"></td>
              <td width="200"><a class="" href="{{ URL::to('team/'.$league_team->team_id )}}">{{$league_team->table_name}}</a></td>
              <td width="20">{{ $league_team->games }}</td>
              <td width="20">{{ $league_team->wins }}</td>
              <td width="20"> {{ $league_team->draws }}</td>
              <td width="20"> {{ $league_team->losts }}</td>
              <td width="20"> {{ $league_team->scores }}</td>
              <td width="20"> {{ $league_team->missed }}</td>
              <td width="20"> {{ $league_team->odds }}</td>
              <td width="20"> {{ $league_team->points }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      @endif
    </div>
  </div>
@endsection


