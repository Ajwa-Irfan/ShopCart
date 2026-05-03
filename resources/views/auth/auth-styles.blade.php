<style>
    .auth-wrapper {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 0;
        max-width: 900px;
        margin: 0 auto;
        background: rgba(255,255,255,0.03);
        border: 1px solid rgba(255,255,255,0.08);
        border-radius: 24px;
        overflow: hidden;
    }

    /* LEFT */
    .auth-left {
        background: linear-gradient(135deg, #1a0e2e, #2d1b4e);
        padding: 50px 40px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        border-right: 1px solid rgba(255,255,255,0.07);
    }
    .auth-brand { margin-bottom: 30px; }
    .auth-heading {
        color: #fff;
        font-size: 2.2rem;
        font-weight: 900;
        line-height: 1.2;
        margin-bottom: 16px;
    }
    .auth-sub {
        color: rgba(255,255,255,0.45);
        font-size: 0.92rem;
        line-height: 1.7;
        margin-bottom: 32px;
    }
    .auth-features { display: flex; flex-direction: column; gap: 14px; }
    .auth-feat {
        color: rgba(255,255,255,0.6);
        font-size: 0.88rem;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .auth-feat span { font-size: 1.1rem; }

    /* RIGHT */
    .auth-right {
        background: rgba(255,255,255,0.02);
        padding: 50px 40px;
    }
    .form-heading {
        color: #fff;
        font-size: 1.4rem;
        font-weight: 800;
        margin-bottom: 6px;
    }
    .form-sub {
        color: rgba(255,255,255,0.4);
        font-size: 0.88rem;
        margin-bottom: 28px;
    }
    .auth-error {
        background: rgba(231,57,88,0.12);
        border: 1px solid rgba(231,57,88,0.3);
        color: #e73958;
        padding: 12px 16px;
        border-radius: 10px;
        font-size: 0.88rem;
        margin-bottom: 20px;
    }
    .form-group { margin-bottom: 18px; }
    .form-label-custom {
        color: rgba(255,255,255,0.5);
        font-size: 0.78rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        display: block;
        margin-bottom: 8px;
    }
    .input-wrap { position: relative; }
    .input-icon {
        position: absolute;
        left: 14px; top: 50%;
        transform: translateY(-50%);
        color: rgba(255,255,255,0.25);
        font-size: 0.85rem;
    }
    .auth-input {
        width: 100%;
        background: rgba(255,255,255,0.06);
        border: 1px solid rgba(255,255,255,0.1);
        border-radius: 10px;
        padding: 12px 16px 12px 40px;
        color: #fff;
        font-size: 0.9rem;
        outline: none;
        transition: border-color 0.2s;
    }
    .auth-input:focus { border-color: #e73958; }
    .auth-input::placeholder { color: rgba(255,255,255,0.2); }
    .remember-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 22px;
    }
    .remember-label {
        display: flex; align-items: center;
        gap: 8px; cursor: pointer;
        color: rgba(255,255,255,0.45);
        font-size: 0.85rem;
    }
    .remember-label input { accent-color: #e73958; }
    .forgot-link {
        color: #e73958;
        text-decoration: none;
        font-size: 0.85rem;
    }
    .forgot-link:hover { text-decoration: underline; }
    .auth-btn {
        width: 100%;
        background: #e73958;
        color: #fff;
        border: none;
        padding: 13px;
        border-radius: 12px;
        font-weight: 700;
        font-size: 0.95rem;
        cursor: pointer;
        transition: all 0.3s;
        margin-bottom: 20px;
    }
    .auth-btn:hover {
        background: #c42d47;
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(231,57,88,0.35);
    }
    .switch-auth {
        text-align: center;
        color: rgba(255,255,255,0.4);
        font-size: 0.88rem;
        margin: 0;
    }
    .switch-auth a {
        color: #e73958;
        text-decoration: none;
        font-weight: 600;
    }
    .switch-auth a:hover { text-decoration: underline; }

    /* Responsive */
    @media (max-width: 768px) {
        .auth-wrapper { grid-template-columns: 1fr; }
        .auth-left { display: none; }
        .auth-right { padding: 40px 28px; }
    }
</style>
