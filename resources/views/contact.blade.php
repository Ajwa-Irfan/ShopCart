@extends('layouts.app')
@section('title', 'Contact Us')

@push('styles')
    <style>
        body { background: #0f1117 !important; }

        .contact-wrap {
            max-width: 1100px;
            margin: 0 auto;
            padding: 56px 24px;
        }
        .contact-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 32px;
        }
        @media(max-width:768px) {
            .contact-grid { grid-template-columns: 1fr; }
        }

        .contact-card {
            background: #1a1d27;
            border-radius: 18px;
            padding: 32px;
            border: 1px solid rgba(255,255,255,0.06);
        }
        .contact-title {
            font-size: 22px;
            font-weight: 800;
            color: #fff;
            margin-bottom: 6px;
        }
        .contact-sub {
            font-size: 13.5px;
            color: #475569;
            margin-bottom: 28px;
        }
        .cf-label {
            display: block;
            font-size: 11.5px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #64748b;
            margin-bottom: 6px;
        }
        .cf-input {
            width: 100%;
            background: rgba(255,255,255,0.04);
            border: 1.5px solid rgba(255,255,255,0.08);
            border-radius: 10px;
            padding: 10px 14px;
            font-size: 14px;
            font-family: inherit;
            color: #e2e8f0;
            outline: none;
            transition: all 0.2s;
            margin-bottom: 18px;
        }
        .cf-input:focus {
            border-color: #e94560;
            background: rgba(233,69,96,0.05);
            box-shadow: 0 0 0 3px rgba(233,69,96,0.1);
        }
        .cf-input::placeholder { color: #334155; }
        textarea.cf-input { resize: vertical; min-height: 130px; }

        .cf-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            background: #e94560;
            color: #fff;
            border: none;
            border-radius: 50px;
            padding: 12px 28px;
            font-size: 14px;
            font-weight: 700;
            font-family: inherit;
            cursor: pointer;
            transition: all 0.2s;
            width: 100%;
        }
        .cf-btn:hover {
            background: #c9384f;
            transform: translateY(-1px);
        }
        .cf-error {
            font-size: 12px;
            color: #ef4444;
            margin-top: -14px;
            margin-bottom: 14px;
        }

        .info-card {
            background: linear-gradient(135deg, #13151e, #1a1d27);
            border-radius: 18px;
            padding: 32px;
            color: #fff;
            border: 1px solid rgba(255,255,255,0.06);
        }
        .info-title {
            font-size: 22px;
            font-weight: 800;
            color: #fff;
            margin-bottom: 6px;
        }
        .info-sub {
            font-size: 13.5px;
            color: #475569;
            margin-bottom: 32px;
        }
        .info-item {
            display: flex;
            align-items: flex-start;
            gap: 14px;
            margin-bottom: 22px;
        }
        .info-icon {
            width: 42px; height: 42px;
            background: rgba(233,69,96,0.12);
            border: 1px solid rgba(233,69,96,0.2);
            border-radius: 11px;
            display: flex; align-items: center; justify-content: center;
            font-size: 18px;
            flex-shrink: 0;
        }
        .info-item-title {
            font-size: 13px;
            font-weight: 700;
            color: #fff;
            margin-bottom: 3px;
        }
        .info-item-text {
            font-size: 13px;
            color: #475569;
        }

        .alert-success-sc {
            background: rgba(16,185,129,0.08);
            border: 1px solid rgba(16,185,129,0.2);
            color: #10b981;
            border-radius: 12px;
            padding: 12px 16px;
            font-size: 13.5px;
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 20px;
        }

        .msg-card {
            background: #1a1d27;
            border-radius: 14px;
            border: 1px solid rgba(255,255,255,0.06);
            overflow: hidden;
            margin-bottom: 14px;
        }
        .msg-header {
            padding: 14px 18px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid rgba(255,255,255,0.04);
        }
        .msg-subject {
            font-size: 14px;
            font-weight: 700;
            color: #fff;
        }
        .msg-date { font-size: 12px; color: #475569; }
        .msg-body { padding: 14px 18px; }
        .msg-text {
            font-size: 13.5px;
            color: #94a3b8;
            line-height: 1.6;
            margin-bottom: 12px;
        }
        .msg-reply {
            background: rgba(16,185,129,0.06);
            border: 1px solid rgba(16,185,129,0.15);
            border-radius: 10px;
            padding: 12px 14px;
        }
        .msg-reply-label {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #10b981;
            margin-bottom: 5px;
        }
        .msg-reply-text {
            font-size: 13.5px;
            color: #e2e8f0;
            line-height: 1.6;
        }
        .badge-replied {
            display: inline-flex; align-items: center; gap: 4px;
            background: rgba(16,185,129,0.1);
            color: #10b981;
            font-size: 11px; font-weight: 700;
            padding: 3px 9px; border-radius: 20px;
        }
        .badge-pending {
            display: inline-flex; align-items: center; gap: 4px;
            background: rgba(245,158,11,0.1);
            color: #f59e0b;
            font-size: 11px; font-weight: 700;
            padding: 3px 9px; border-radius: 20px;
        }
    </style>
@endpush

@section('content')
    <div class="contact-wrap">

        {{-- Header --}}
        <div style="margin-bottom:36px">
            <div style="width:44px;height:4px;background:#e94560;
                    border-radius:4px;margin-bottom:10px"></div>
            <h1 style="font-size:28px;font-weight:800;color:#fff;margin-bottom:5px">
                Contact Us
            </h1>
            <p style="font-size:14px;color:#475569">
                Have a question? We'd love to hear from you.
            </p>
        </div>

        @if(session('success'))
            <div class="alert-success-sc">
                <i class="bi bi-check-circle-fill"></i>
                {{ session('success') }}
            </div>
        @endif

        <div class="contact-grid">

            {{-- Form --}}
            <div class="contact-card">
                <div class="contact-title">Send a Message</div>
                <div class="contact-sub">
                    Fill out the form and we'll get back to you shortly.
                </div>

                <form action="{{ route('contact.store') }}" method="POST">
                    @csrf

                    <label class="cf-label">Subject</label>
                    <input type="text" name="subject"
                           class="cf-input"
                           value="{{ old('subject') }}"
                           placeholder="What is this about?" required>
                    @error('subject')
                    <div class="cf-error">{{ $message }}</div>
                    @enderror

                    <label class="cf-label">Message</label>
                    <textarea name="message"
                              class="cf-input"
                              placeholder="Write your message here..."
                              required>{{ old('message') }}</textarea>
                    @error('message')
                    <div class="cf-error">{{ $message }}</div>
                    @enderror

                    <button type="submit" class="cf-btn">
                        <i class="bi bi-send-fill"></i> Send Message
                    </button>
                </form>
            </div>

            {{-- Info --}}
            <div class="info-card">
                <div class="info-title">Get in Touch</div>
                <div class="info-sub">
                    We're here to help. Reach us through any channel.
                </div>

                <div class="info-item">
                    <div class="info-icon">📧</div>
                    <div>
                        <div class="info-item-title">Email</div>
                        <div class="info-item-text">support@shopcart.pk</div>
                    </div>
                </div>
                <div class="info-item">
                    <div class="info-icon">📞</div>
                    <div>
                        <div class="info-item-title">Phone</div>
                        <div class="info-item-text">+92 300 1234567</div>
                    </div>
                </div>
                <div class="info-item">
                    <div class="info-icon">📍</div>
                    <div>
                        <div class="info-item-title">Address</div>
                        <div class="info-item-text">Lahore, Punjab, Pakistan</div>
                    </div>
                </div>
                <div class="info-item">
                    <div class="info-icon">🕐</div>
                    <div>
                        <div class="info-item-title">Working Hours</div>
                        <div class="info-item-text">Mon–Sat: 9am – 6pm</div>
                    </div>
                </div>
            </div>

        </div>

        {{-- Previous Messages --}}
        @if($messages->count())
            <div style="margin-top:48px">
                <div style="width:44px;height:4px;background:#e94560;
                    border-radius:4px;margin-bottom:10px"></div>
                <h3 style="font-size:20px;font-weight:800;
                   color:#fff;margin-bottom:20px">
                    Your Previous Messages
                </h3>

                @foreach($messages as $msg)
                    <div class="msg-card">
                        <div class="msg-header">
                            <div class="msg-subject">
                                <i class="bi bi-chat-left-text"
                                   style="color:#e94560;margin-right:6px"></i>
                                {{ $msg->subject }}
                            </div>
                            <div style="display:flex;align-items:center;gap:10px">
                                @if($msg->replied)
                                    <span class="badge-replied">
                            <i class="bi bi-check-circle-fill"></i> Replied
                        </span>
                                @else
                                    <span class="badge-pending">
                            <i class="bi bi-clock-fill"></i> Pending
                        </span>
                                @endif
                                <span class="msg-date">
                        {{ $msg->created_at->format('d M Y') }}
                    </span>
                            </div>
                        </div>
                        <div class="msg-body">
                            <div class="msg-text">{{ $msg->message }}</div>
                            @if($msg->replied)
                                <div class="msg-reply">
                                    <div class="msg-reply-label">
                                        <i class="bi bi-reply-fill"></i> Admin Reply
                                    </div>
                                    <div class="msg-reply-text">
                                        {{ $msg->admin_reply }}
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

    </div>
@endsection
