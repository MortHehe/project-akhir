@extends('layouts.auth')

@section('title', 'My Profile')
@section('menu-profile', 'active')

@section('additional-styles')
<style>
    .profile-grid {
        display: grid;
        grid-template-columns: 1fr 2fr;
        gap: 30px;
        margin-bottom: 30px;
    }

    .profile-card {
        background: white;
        padding: 35px;
        border-radius: 20px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.06);
        text-align: center;
    }

    .profile-avatar-large {
        width: 120px;
        height: 120px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 800;
        font-size: 48px;
        margin: 0 auto 20px;
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
    }

    .profile-name {
        font-size: 24px;
        font-weight: 800;
        margin-bottom: 8px;
        color: #1a1a1a;
    }

    .profile-email {
        color: #666;
        font-size: 14px;
        margin-bottom: 20px;
    }

    .profile-stats {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 15px;
        margin-top: 25px;
        padding-top: 25px;
        border-top: 2px solid #f0f0f0;
    }

    .stat-item {
        text-align: center;
    }

    .stat-value {
        font-size: 28px;
        font-weight: 800;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .stat-label {
        font-size: 12px;
        color: #999;
        text-transform: uppercase;
        margin-top: 5px;
        font-weight: 600;
    }

    .skills-grid {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 15px;
    }

    .skill-tag {
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.1), rgba(118, 75, 162, 0.1));
        color: #667eea;
        padding: 8px 16px;
        border-radius: 20px;
        font-size: 13px;
        font-weight: 600;
        border: 2px solid #667eea;
        text-transform: uppercase;
    }

    .btn-group {
        display: flex;
        gap: 15px;
        margin-top: 25px;
    }

    @media (max-width: 968px) {
        .profile-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('content')
    <div class="page-header">
        <h1>👤 My Profile</h1>
        <p>Manage your freelancer profile and portfolio</p>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            ✅ {{ session('success') }}
        </div>
    @endif

    <div class="profile-grid">
        <!-- Profile Summary -->
        <div class="profile-card">
            <div class="profile-avatar-large">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>
            <div class="profile-name">{{ auth()->user()->name }}</div>
            <div class="profile-email">{{ auth()->user()->email }}</div>
            <span class="badge" style="display: inline-block; background: linear-gradient(135deg, #667eea, #764ba2);">Freelancer Account</span>

            <div class="profile-stats">
                <div class="stat-item">
                    <div class="stat-value">{{ auth()->user()->freelancerOrders()->where('status', 'completed')->count() }}</div>
                    <div class="stat-label">Completed</div>
                </div>
                <div class="stat-item">
                    <div class="stat-value">{{ number_format(auth()->user()->average_rating ?? 0, 1) }}</div>
                    <div class="stat-label">Rating</div>
                </div>
            </div>

            <div class="btn-group" style="flex-direction: column;">
                <a href="{{ route('freelancer.settings') }}" class="btn btn-primary">⚙️ Edit Settings</a>
                <a href="{{ route('freelancer.earnings') }}" class="btn btn-secondary">💰 View Earnings</a>
            </div>
        </div>

        <!-- Profile Details -->
        <div>
            <div class="card">
                <h2>📋 Personal Information</h2>
                <p style="color: #666; margin-bottom: 25px;">Update your freelancer details</p>

                <form method="POST" action="{{ route('freelancer.myprofile.update') }}">
                    @csrf
                    @method('PATCH')

                    <div class="form-row">
                        <div class="form-group">
                            <label>Full Name</label>
                            <input type="text" name="name" value="{{ auth()->user()->name }}" required>
                        </div>

                        <div class="form-group">
                            <label>Professional Title</label>
                            <input type="text" name="title" value="{{ auth()->user()->title ?? '' }}" placeholder="e.g., Full Stack Developer">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Email Address</label>
                            <input type="email" value="{{ auth()->user()->email }}" disabled style="background: #f5f5f5;">
                            <small style="color: #999; font-size: 12px; display: block; margin-top: 5px;">Email cannot be changed here</small>
                        </div>

                        <div class="form-group">
                            <label>Phone Number</label>
                            <input type="tel" name="phone" value="{{ auth()->user()->phone ?? '' }}" placeholder="+1 234 567 8900">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Hourly Rate (USD)</label>
                            <input type="number" name="hourly_rate" value="{{ auth()->user()->hourly_rate ?? '' }}" placeholder="50" min="0" step="5">
                        </div>

                        <div class="form-group">
                            <label>Location</label>
                            <input type="text" name="location" value="{{ auth()->user()->location ?? '' }}" placeholder="City, Country">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Bio / About Me</label>
                        <textarea name="bio" rows="4" placeholder="Tell clients about your experience and expertise...">{{ auth()->user()->bio ?? '' }}</textarea>
                    </div>

                    <div class="btn-group">
                        <button type="submit" class="btn btn-primary">💾 Save Changes</button>
                        <button type="reset" class="btn btn-secondary">↺ Reset</button>
                    </div>
                </form>
            </div>

            <div class="card">
                <h2>🛠️ Skills & Expertise</h2>
                <p style="color: #666; margin-bottom: 25px;">Add your professional skills</p>

                <form method="POST" action="{{ route('freelancer.skills.update') }}">
                    @csrf

                    <div class="form-group">
                        <label>Your Skills (comma separated)</label>
                        @php
                            $userSkills = auth()->user()->skills;

                            // If it's a string, try to decode JSON
                            if (is_string($userSkills)) {
                                $decoded = json_decode($userSkills, true);
                                $userSkills = is_array($decoded) ? $decoded : explode(',', $userSkills);
                            }

                            // If it's an array, implode with commas
                            if (is_array($userSkills)) {
                                $userSkills = implode(', ', array_map('trim', $userSkills));
                            } else {
                                $userSkills = $userSkills ?? '';
                            }
                        @endphp
                        <textarea name="skills" rows="3" placeholder="e.g., PHP, Laravel, JavaScript, React, Vue.js">{{ $userSkills }}</textarea>
                        <small style="color: #999; font-size: 12px; display: block; margin-top: 5px;">Separate each skill with a comma</small>
                    </div>

                    @php
                        $currentSkills = auth()->user()->skills;
                        if (is_string($currentSkills)) {
                            $currentSkills = json_decode($currentSkills, true);
                        }
                        if (!is_array($currentSkills)) {
                            $currentSkills = [];
                        }
                    @endphp

                    @if(count($currentSkills) > 0)
                        <div style="margin-bottom: 20px;">
                            <label style="display: block; margin-bottom: 10px; font-weight: 700;">Current Skills:</label>
                            <div class="skills-grid">
                                @foreach($currentSkills as $skill)
                                    <span class="skill-tag">{{ $skill }}</span>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <div class="btn-group">
                        <button type="submit" class="btn btn-primary">💾 Update Skills</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
