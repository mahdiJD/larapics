<x-layout title="Manage Comments">
    <div class="container py-4">
        <h1>Comments</h1>
        <x-flash-message/>
        <table class="table mt-4">
            <thead>
                <tr>
                    <th width='20'>No</th>
                    <th>Author</th>
                    <th>Comment</th>
                    <th width='130'>Comment on</th>
                    <th width='250'>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($comments as $comment)
                <tr>
                    <td>1</td>
                    <td>{{$comment->user->username}}</td>
                    <td>{{$comment->body}}</td>
                    <td>
                        <img src="{{ $comment->image->fileUrl() }}" width="100" alt="{{ $comment->image->title }}">
                    </td>
                    <td>
                        <x-form method="PUT" action="{{route('comment.update',$comment->id)}}" style='display: inline'>
                            <input type="hidden" name="approve"
                            value="{{ $comment->approved ? 0 : 1 }}">
                            <button type="submit"
                            class="btn btn-sm btn-outline-success">
                            {{ $comment->approved ? "Unapprove" : "Approve" }}
                            </button>
                        </x-form>
                        <a href="{{ route('comments.reply.create', $comment->id ) }}" class="btn btn-sm btn-outline-primary">Reply</a>

                        <x-form method='DELETE'
                            action='{{ route("comment.delete",$comment->id) }}'
                            style='display: inline'>

                            <button type="submit"
                            class="btn btn-sm btn-outline-danger"
                            onclick="return confirm('Are you sure?')"
                            >Remove</button>
                        </x-form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div>
        {{ $comments->links() }}
    </div>

</x-layout>

