@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <ol class="breadcrumb">
          <li v-for="user in usersInRoom"><a href="#">@{{ user.name }}</a></li>
        </ol>
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Chatroom
                    <span class="badge pull-right">@{{ usersInRoom.length }}</span>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <chat-log :messages="messages"></chat-log>
                        <hr>
                    </div>
                    <chat-composer @messagesent='addMessage'></chat-composer>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script src="{{ mix('js/chat.js') }}"></script>
@endsection
