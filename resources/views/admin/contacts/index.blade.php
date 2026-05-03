@extends('layouts.admin')
@section('title', 'Messages')

@section('content')

    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h4 style="font-weight:800;color:#fff;margin:0">Contact Messages</h4>
            <div style="font-size:13px;color:#475569;margin-top:3px">
                {{ $contacts->where('replied', false)->count() }} pending replies
            </div>
        </div>
    </div>

    <div class="sc-card">
        <div class="sc-card-body">
            <table class="sc-table" id="contactsTable">
                <thead>
                <tr>
                    <th>#</th>
                    <th>User</th>
                    <th>Subject</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @forelse($contacts as $contact)
                    <tr>
                        <td style="color:#475569">{{ $loop->iteration }}</td>
                        <td>
                            <div style="font-weight:600;color:#fff">
                                {{ $contact->user->name ?? 'N/A' }}
                            </div>
                            <div style="font-size:12px;color:#475569">
                                {{ $contact->user->email ?? '' }}
                            </div>
                        </td>
                        <td style="font-weight:500">{{ $contact->subject }}</td>
                        <td>
                            @if($contact->replied)
                                <span class="sc-badge sc-badge-success">
                                <i class="bi bi-check-circle-fill"></i> Replied
                            </span>
                            @else
                                <span class="sc-badge sc-badge-warning">
                                <i class="bi bi-clock-fill"></i> Pending
                            </span>
                            @endif
                        </td>
                        <td style="color:#475569;font-size:13px">
                            {{ $contact->created_at->format('d M Y') }}
                        </td>
                        <td>
                            <button class="sc-btn sc-btn-primary sc-btn-sm"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modal{{ $contact->id }}">
                                <i class="bi bi-eye-fill"></i>
                                {{ $contact->replied ? 'View' : 'Reply' }}
                            </button>
                        </td>
                    </tr>

                    {{-- Modal --}}
                    <div class="modal fade" id="modal{{ $contact->id }}" tabindex="-1">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content"
                                 style="background:#1a1d27;border:1px solid rgba(255,255,255,0.08);border-radius:16px">
                                <div class="modal-header"
                                     style="border-bottom:1px solid rgba(255,255,255,0.06);padding:16px 20px">
                                    <h5 style="font-size:15px;font-weight:700;color:#fff;margin:0">
                                        <i class="bi bi-chat-left-text-fill"
                                           style="color:#6c63ff;margin-right:8px"></i>
                                        {{ $contact->subject }}
                                    </h5>
                                    <button type="button" class="btn-close btn-close-white"
                                            data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body" style="padding:20px">
                                    <div style="display:flex;align-items:center;gap:10px;margin-bottom:16px">
                                        <div style="width:36px;height:36px;background:linear-gradient(135deg,#6c63ff,#e94560);border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:14px;font-weight:700;color:#fff">
                                            {{ strtoupper(substr($contact->user->name ?? 'U', 0, 1)) }}
                                        </div>
                                        <div>
                                            <div style="font-size:13.5px;font-weight:600;color:#fff">
                                                {{ $contact->user->name ?? 'N/A' }}
                                            </div>
                                            <div style="font-size:12px;color:#475569">
                                                {{ $contact->created_at->format('d M Y, h:i A') }}
                                            </div>
                                        </div>
                                    </div>

                                    <div style="background:rgba(255,255,255,0.04);border:1px solid rgba(255,255,255,0.06);border-radius:10px;padding:14px 16px;margin-bottom:16px">
                                        <div style="font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:0.5px;color:#475569;margin-bottom:8px">Message</div>
                                        <div style="font-size:14px;color:#e2e8f0;line-height:1.7">{{ $contact->message }}</div>
                                    </div>

                                    @if($contact->replied)
                                        <div style="background:rgba(16,185,129,0.08);border:1px solid rgba(16,185,129,0.2);border-radius:10px;padding:14px 16px">
                                            <div style="font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:0.5px;color:#10b981;margin-bottom:8px">
                                                <i class="bi bi-reply-fill"></i> Your Reply
                                            </div>
                                            <div style="font-size:14px;color:#e2e8f0;line-height:1.7">{{ $contact->admin_reply }}</div>
                                        </div>
                                    @else
                                        <form action="{{ route('admin.contacts.reply', $contact->id) }}" method="POST">
                                            @csrf
                                            <div style="margin-bottom:12px">
                                                <label class="sc-form-label">Write Reply</label>
                                                <textarea name="admin_reply" class="sc-form-control"
                                                          rows="4" placeholder="Type your reply..." required></textarea>
                                            </div>
                                            <button type="submit" class="sc-btn sc-btn-primary">
                                                <i class="bi bi-send-fill"></i> Send Reply
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                @empty
                    <tr>
                        <td colspan="6" style="text-align:center;padding:40px;color:#475569">
                            <div style="font-size:32px;margin-bottom:8px">💬</div>
                            No messages yet
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function() {
                $('#contactsTable').DataTable({
                    responsive: true,
                    pageLength: 10,
                    language: {
                        search: "",
                        searchPlaceholder: "Search messages...",
                        paginate: {
                            previous: "<i class='bi bi-chevron-left'></i>",
                            next: "<i class='bi bi-chevron-right'></i>"
                        }
                    },
                    columnDefs: [
                        { orderable: false, targets: [5] }
                    ]
                });
            });
        </script>
    @endpush
@endsection
