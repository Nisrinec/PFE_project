{{-- @foreach ($comments as $comment)
    <div class="comment border  border-1 p-4 rounded-lg" id="comment-{{ $comment->id }}">
        <div class="media">
            <img class="mr-3 rounded-circle" alt="User Avatar"
                src="{{ $comment->user->picture ? asset('storage/public/' . $comment->user->picture) : asset('images/profile-icon.png') }}">
            <div class="media-body">
                <div class="row">
                    <div class="col-8 d-flex align-items-center">
                        <h5 class="mb-0">{{ $comment->user->name }} </h5>
                        <span class="comment-date pl-2"> -
                            {{ \Carbon\Carbon::parse($comment->created_at)->format('d/m/Y H:i') }}</span>
                    </div>
                    <div class="col-4 d-flex justify-content-end">
                        <!-- Three-Dot Menu for Edit/Delete -->
                        <div class="d-flex flex-column">

                            @if (auth()->check() && auth()->id() === $comment->user_id)
                                <div class="dropdown">
                                    <button class="btn btn-link dropdown-toggle" type="button"
                                        id="commentOptions-{{ $comment->id }}" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-h"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="commentOptions-{{ $comment->id }}">
                                        <a class="dropdown-item"
                                            href="{{ route('comments.edit', $comment->id) }}">Edit</a>
                                        <form action="{{ route('comments.destroy', $comment->id) }}" method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this comment?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item text-danger">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            @endif
                           
                        </div>
                    </div>
                </div>
                <p >{{ $comment->content }}</p>
                @auth
                <div class="d-flex justify-content-end mb-2">
                    <div class="pull-right reply">
                        <a href="#" class="reply-link" data-comment-id="{{ $comment->id }}"><span><i class="fa fa-reply"></i> reply</span></a>
                    </div>
                </div>
                <!-- Nested comments -->
                @include('components.comment', ['comments' => $comment->replies])
                <!-- Reply Form -->
                <div class="reply-form d-none" id="reply-form-{{ $comment->id }}">
                    <form action="{{ route('comments.reply', $comment->id) }}" method="POST">
                        @csrf
                        <input type="hidden" name="parent_comment_id" value="{{ $comment->id }}">
                        <textarea name="reply_text" required placeholder="Write your reply here..."></textarea>
                        <button type="submit">Submit Reply</button>
                    </form>
                </div>
                
                @endauth
            </div>
        </div>
    </div>
@endforeach --}}
@foreach ($comments as $comment)
    <div class="comment" id="comment-{{ $comment->id }}">
        <div class="media">
            <img class="mr-3 rounded-circle" alt="User Avatar" src="{{ $comment->user->picture ? asset('storage/public/' . $comment->user->picture) : asset('images/profile-icon.png') }}">
            <div class="media-body">
                <div class="row">
                    <div class="col-8 d-flex">
                        <h5>{{ $comment->user->name }}</h5>
                        <span class="comment-date"> - {{ \Carbon\Carbon::parse($comment->created_at)->format('d/m/Y H:i') }}</span>
                    </div>
                    @auth
                    <div class="col-4">
                        <div class="pull-right reply">
                            <a href="#" class="reply-link" data-comment-id="{{ $comment->id }}"><span><i class="fa fa-reply"></i> reply</span></a>
                        </div>
                    </div>
                    @endauth
                </div>
                <p>{{ $comment->content }}</p>
                <!-- Nested comments -->
                @include('components.comment', ['comments' => $comment->replies])
                <!-- Reply Form -->
                <div class="reply-form">
                    <form action="{{ route('comments.store', $post) }}" method="POST">
                        @csrf
                        <input type="hidden" name="post_id" value="{{ $post->id }}">
                        <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                        <textarea name="content" required placeholder="Write your reply here..."></textarea>
                        <button type="submit">Submit Reply</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach
