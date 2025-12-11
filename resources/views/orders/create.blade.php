<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Order - WORKZY</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f7fa;
            color: #333;
        }

        /* Navigation */
        nav {
            background: white;
            padding: 20px 60px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 32px;
            font-weight: 900;
            letter-spacing: -2px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .nav-links a {
            margin-left: 30px;
            text-decoration: none;
            color: #333;
            font-weight: 500;
            transition: color 0.3s;
        }

        .nav-links a:hover {
            color: #667eea;
        }

        /* Page Header */
        .page-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 60px 60px 40px;
            color: white;
        }

        .page-header h1 {
            font-size: 42px;
            margin-bottom: 10px;
        }

        .page-header p {
            font-size: 18px;
            opacity: 0.95;
        }

        /* Main Content */
        .main-content {
            max-width: 1200px;
            margin: -40px auto 60px;
            padding: 0 60px;
        }

        .order-form-container {
            background: white;
            border-radius: 16px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.1);
            overflow: hidden;
        }

        .form-progress {
            display: flex;
            background: #f8f9fa;
            padding: 30px;
            gap: 20px;
        }

        .progress-step {
            flex: 1;
            text-align: center;
            position: relative;
        }

        .progress-step-number {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: #e1e8ed;
            color: #999;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 20px;
            margin: 0 auto 10px;
            transition: all 0.3s;
        }

        .progress-step.active .progress-step-number {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .progress-step.completed .progress-step-number {
            background: #4CAF50;
            color: white;
        }

        .progress-step-label {
            font-size: 14px;
            color: #666;
            font-weight: 500;
        }

        .progress-step.active .progress-step-label {
            color: #333;
            font-weight: 700;
        }

        /* Form Content */
        .form-content {
            padding: 40px 50px;
        }

        .form-section {
            display: none;
        }

        .form-section.active {
            display: block;
        }

        .section-title {
            font-size: 24px;
            font-weight: 700;
            color: #333;
            margin-bottom: 10px;
        }

        .section-description {
            font-size: 16px;
            color: #666;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
        }

        .form-group label .required {
            color: #e74c3c;
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 14px 18px;
            border: 2px solid #e1e8ed;
            border-radius: 8px;
            font-size: 15px;
            font-family: inherit;
            transition: all 0.3s;
        }

        .form-group input:focus,
        .form-group textarea:focus,
        .form-group select:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .form-group textarea {
            resize: vertical;
            min-height: 120px;
        }

        .form-group .help-text {
            font-size: 13px;
            color: #999;
            margin-top: 5px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        /* Freelancer Selection */
        .freelancer-selection {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 20px;
        }

        .freelancer-option {
            border: 2px solid #e1e8ed;
            border-radius: 12px;
            padding: 20px;
            cursor: pointer;
            transition: all 0.3s;
            position: relative;
        }

        .freelancer-option:hover {
            border-color: #667eea;
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.1);
        }

        .freelancer-option.selected {
            border-color: #667eea;
            background: #f8f9ff;
        }

        .freelancer-option input[type="radio"] {
            position: absolute;
            top: 15px;
            right: 15px;
            width: 20px;
            height: 20px;
        }

        .freelancer-avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 24px;
            font-weight: 700;
            margin: 0 auto 10px;
        }

        .freelancer-name {
            font-weight: 700;
            color: #333;
            text-align: center;
            margin-bottom: 5px;
        }

        .freelancer-title {
            font-size: 13px;
            color: #666;
            text-align: center;
            margin-bottom: 10px;
        }

        .freelancer-rating {
            text-align: center;
            font-size: 14px;
            color: #667eea;
            font-weight: 600;
        }

        .freelancer-skills {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
            justify-content: center;
            margin-top: 12px;
        }

        .skill-tag {
            background: #f0f0ff;
            color: #667eea;
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
        }

        /* Order Summary */
        .order-summary {
            background: #f8f9ff;
            border: 2px solid #e1e8ed;
            border-radius: 12px;
            padding: 25px;
        }

        .summary-title {
            font-size: 20px;
            font-weight: 700;
            color: #333;
            margin-bottom: 20px;
        }

        .summary-item {
            display: flex;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px solid #e1e8ed;
        }

        .summary-item:last-child {
            border-bottom: none;
            font-weight: 700;
            font-size: 18px;
            color: #667eea;
            padding-top: 15px;
        }

        .summary-label {
            color: #666;
            font-size: 14px;
        }

        .summary-value {
            color: #333;
            font-weight: 600;
        }

        /* Form Actions */
        .form-actions {
            display: flex;
            justify-content: space-between;
            margin-top: 40px;
            padding-top: 30px;
            border-top: 2px solid #f0f0f0;
        }

        .btn {
            padding: 14px 35px;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            border: none;
        }

        .btn-back {
            background: transparent;
            color: #666;
            border: 2px solid #e1e8ed;
        }

        .btn-back:hover {
            border-color: #667eea;
            color: #667eea;
        }

        .btn-next,
        .btn-submit {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .btn-next:hover,
        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(102, 126, 234, 0.3);
        }

        .btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        /* Alerts */
        .alert {
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        /* Footer */
        footer {
            background: #2c3e50;
            color: white;
            padding: 40px 60px;
            margin-top: 60px;
            text-align: center;
        }

        footer p {
            opacity: 0.8;
        }

        @media (max-width: 768px) {
            .form-row {
                grid-template-columns: 1fr;
            }

            .freelancer-selection {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav>
        <div class="logo">WORKZY</div>
        <div class="nav-links">
            <a href="{{ route('welcome') }}">Home</a>
            <a href="{{ route('find-freelancers') }}">Find Freelancers</a>
            <a href="{{ route('user.dashboard') }}">Dashboard</a>
            <a href="{{ route('chat.index') }}">Messages</a>
        </div>
    </nav>

    <!-- Page Header -->
    <div class="page-header">
        <h1>Create New Order</h1>
        <p>Tell us about your project and we'll help you find the perfect freelancer</p>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="order-form-container">
            <!-- Progress Steps -->
            <div class="form-progress">
                <div class="progress-step active" id="step-indicator-1">
                    <div class="progress-step-number">1</div>
                    <div class="progress-step-label">Project Details</div>
                </div>
                <div class="progress-step" id="step-indicator-2">
                    <div class="progress-step-number">2</div>
                    <div class="progress-step-label">Select Freelancer</div>
                </div>
                <div class="progress-step" id="step-indicator-3">
                    <div class="progress-step-number">3</div>
                    <div class="progress-step-label">Review & Submit</div>
                </div>
            </div>

            <!-- Form Content -->
            <form action="{{ route('orders.store') }}" method="POST" id="orderForm">
                @csrf

                <div class="form-content">
                    @if ($errors->any())
                        <div class="alert alert-error">
                            <strong>Please fix the following errors:</strong>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Step 1: Project Details -->
                    <div class="form-section active" id="step-1">
                        <div class="section-title">Project Details</div>
                        <div class="section-description">Provide information about your project to help freelancers understand your needs</div>

                        <div class="form-group">
                            <label>Project Title <span class="required">*</span></label>
                            <input type="text" name="job_title" id="job_title" placeholder="e.g., Modern E-commerce Website Development" value="{{ old('job_title') }}" required>
                            <div class="help-text">Give your project a clear, descriptive title</div>
                        </div>

                        <div class="form-group">
                            <label>Project Description <span class="required">*</span></label>
                            <textarea name="job_description" id="job_description" placeholder="Describe your project in detail..." required>{{ old('job_description') }}</textarea>
                            <div class="help-text">Include goals, expected deliverables, and any specific requirements</div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label>Budget (USD) <span class="required">*</span></label>
                                <input type="number" name="price" id="price" placeholder="500" min="1" step="0.01" value="{{ old('price') }}" required>
                                <div class="help-text">Your project budget</div>
                            </div>

                            <div class="form-group">
                                <label>Deadline</label>
                                <input type="date" name="deadline" id="deadline" value="{{ old('deadline') }}" min="{{ date('Y-m-d', strtotime('+1 day')) }}">
                                <div class="help-text">When do you need this completed?</div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Additional Requirements</label>
                            <textarea name="requirements" id="requirements" placeholder="Any special requirements, tools, or technologies needed...">{{ old('requirements') }}</textarea>
                            <div class="help-text">Optional: List any technical requirements or preferences</div>
                        </div>
                    </div>

                    <!-- Step 2: Select Freelancer -->
                    <div class="form-section" id="step-2">
                        <div class="section-title">Select Freelancer</div>
                        <div class="section-description">Choose a freelancer for your project or leave it open for applications</div>

                        <div class="form-group">
                            <div class="freelancer-selection">
                                <div class="freelancer-option" onclick="selectFreelancer(null, this)">
                                    <input type="radio" name="freelancer_id" value="" checked>
                                    <div class="freelancer-avatar">🌟</div>
                                    <div class="freelancer-name">Open to All</div>
                                    <div class="freelancer-title">Let freelancers apply</div>
                                    <div class="freelancer-rating">Post publicly</div>
                                </div>

                                @foreach($freelancers as $freelancer)
                                    <div class="freelancer-option {{ request('freelancer_id') == $freelancer->id ? 'selected' : '' }}" onclick="selectFreelancer({{ $freelancer->id }}, this)">
                                        <input type="radio" name="freelancer_id" value="{{ $freelancer->id }}" {{ request('freelancer_id') == $freelancer->id ? 'checked' : '' }}>
                                        <input type="hidden" name="freelancer_email_{{ $freelancer->id }}" value="{{ $freelancer->email }}">
                                        <div class="freelancer-avatar">{{ strtoupper(substr($freelancer->name, 0, 1)) }}</div>
                                        <div class="freelancer-name">{{ $freelancer->name }}</div>
                                        <div class="freelancer-title">{{ $freelancer->title ?? 'Professional Freelancer' }}</div>
                                        <div class="freelancer-rating">⭐ {{ number_format($freelancer->getAverageRatingAttribute(), 1) }} ({{ $freelancer->getTotalReviewsAttribute() }} reviews)</div>

                                        @php
                                            // Parse skills properly
                                            $skills = $freelancer->skills;

                                            // If it's a string, try to decode JSON
                                            if (is_string($skills)) {
                                                $decoded = json_decode($skills, true);
                                                $skills = is_array($decoded) ? $decoded : explode(',', $skills);
                                            }

                                            // If not an array, make it one
                                            if (!is_array($skills)) {
                                                $skills = [];
                                            }

                                            // Clean up skills - remove empty values and trim
                                            $skills = array_filter(array_map('trim', $skills));
                                        @endphp

                                        @if(!empty($skills))
                                            <div class="freelancer-skills">
                                                @foreach(array_slice($skills, 0, 3) as $skill)
                                                    <span class="skill-tag">{{ $skill }}</span>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Step 3: Review & Submit -->
                    <div class="form-section" id="step-3">
                        <div class="section-title">Review Your Order</div>
                        <div class="section-description">Please review all details before submitting your order</div>

                        <div class="order-summary">
                            <div class="summary-title">Order Summary</div>

                            <div class="summary-item">
                                <span class="summary-label">Project Title:</span>
                                <span class="summary-value" id="summary-title">-</span>
                            </div>

                            <div class="summary-item">
                                <span class="summary-label">Description:</span>
                                <span class="summary-value" id="summary-description">-</span>
                            </div>

                            <div class="summary-item">
                                <span class="summary-label">Budget:</span>
                                <span class="summary-value" id="summary-price">-</span>
                            </div>

                            <div class="summary-item">
                                <span class="summary-label">Deadline:</span>
                                <span class="summary-value" id="summary-deadline">-</span>
                            </div>

                            <div class="summary-item">
                                <span class="summary-label">Freelancer:</span>
                                <span class="summary-value" id="summary-freelancer">Open to all</span>
                            </div>

                            <div class="summary-item">
                                <span class="summary-label">Total Amount:</span>
                                <span class="summary-value" id="summary-total">-</span>
                            </div>
                        </div>

                        <input type="hidden" name="freelancer_email" id="selected_freelancer_email">
                    </div>

                    <!-- Form Actions -->
                    <div class="form-actions">
                        <button type="button" class="btn btn-back" id="btnBack" style="display: none;" onclick="previousStep()">← Back</button>
                        <button type="button" class="btn btn-next" id="btnNext" onclick="nextStep()">Next →</button>
                        <button type="submit" class="btn btn-submit" id="btnSubmit" style="display: none;">Submit Order</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 WORKZY. All rights reserved.</p>
    </footer>

    <script>
        let currentStep = 1;
        const totalSteps = 3;
        let selectedFreelancerEmail = '';

        function showStep(step) {
            // Hide all steps
            document.querySelectorAll('.form-section').forEach(section => {
                section.classList.remove('active');
            });

            // Show current step
            document.getElementById(`step-${step}`).classList.add('active');

            // Update progress indicators
            for (let i = 1; i <= totalSteps; i++) {
                const indicator = document.getElementById(`step-indicator-${i}`);
                indicator.classList.remove('active', 'completed');

                if (i < step) {
                    indicator.classList.add('completed');
                } else if (i === step) {
                    indicator.classList.add('active');
                }
            }

            // Update buttons
            const btnBack = document.getElementById('btnBack');
            const btnNext = document.getElementById('btnNext');
            const btnSubmit = document.getElementById('btnSubmit');

            if (step === 1) {
                btnBack.style.display = 'none';
                btnNext.style.display = 'block';
                btnSubmit.style.display = 'none';
            } else if (step === totalSteps) {
                btnBack.style.display = 'block';
                btnNext.style.display = 'none';
                btnSubmit.style.display = 'block';
                updateSummary();
            } else {
                btnBack.style.display = 'block';
                btnNext.style.display = 'block';
                btnSubmit.style.display = 'none';
            }
        }

        function nextStep() {
            if (currentStep < totalSteps) {
                // Validate current step
                if (validateStep(currentStep)) {
                    currentStep++;
                    showStep(currentStep);
                }
            }
        }

        function previousStep() {
            if (currentStep > 1) {
                currentStep--;
                showStep(currentStep);
            }
        }

        function validateStep(step) {
            if (step === 1) {
                const title = document.getElementById('job_title').value.trim();
                const description = document.getElementById('job_description').value.trim();
                const price = document.getElementById('price').value;

                if (!title) {
                    alert('Please enter a project title');
                    return false;
                }

                if (!description) {
                    alert('Please enter a project description');
                    return false;
                }

                if (!price || price <= 0) {
                    alert('Please enter a valid budget');
                    return false;
                }
            }

            return true;
        }

        function selectFreelancer(freelancerId, element) {
            // Remove selected class from all options
            document.querySelectorAll('.freelancer-option').forEach(option => {
                option.classList.remove('selected');
            });

            // Add selected class to clicked option
            element.classList.add('selected');

            // Update selected freelancer email
            if (freelancerId) {
                const emailInput = document.querySelector(`input[name="freelancer_email_${freelancerId}"]`);
                selectedFreelancerEmail = emailInput ? emailInput.value : '';
            } else {
                selectedFreelancerEmail = '';
            }

            // Update hidden field
            document.getElementById('selected_freelancer_email').value = selectedFreelancerEmail;
        }

        function updateSummary() {
            // Update summary with form values
            const title = document.getElementById('job_title').value || '-';
            const description = document.getElementById('job_description').value || '-';
            const price = document.getElementById('price').value;
            const deadline = document.getElementById('deadline').value || 'Not specified';

            document.getElementById('summary-title').textContent = title;
            document.getElementById('summary-description').textContent = description.substring(0, 100) + (description.length > 100 ? '...' : '');
            document.getElementById('summary-price').textContent = price ? `$${parseFloat(price).toFixed(2)}` : '-';
            document.getElementById('summary-deadline').textContent = deadline;
            document.getElementById('summary-total').textContent = price ? `$${parseFloat(price).toFixed(2)}` : '-';

            // Update freelancer selection
            const selectedRadio = document.querySelector('input[name="freelancer_id"]:checked');
            const freelancerOption = selectedRadio ? selectedRadio.closest('.freelancer-option') : null;
            const freelancerName = freelancerOption ? freelancerOption.querySelector('.freelancer-name').textContent : 'Open to all';
            document.getElementById('summary-freelancer').textContent = freelancerName;
        }

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function() {
            showStep(1);

            // Auto-select freelancer if passed via URL
            const urlParams = new URLSearchParams(window.location.search);
            const freelancerId = urlParams.get('freelancer_id');
            if (freelancerId) {
                const freelancerOption = document.querySelector(`input[name="freelancer_id"][value="${freelancerId}"]`);
                if (freelancerOption) {
                    freelancerOption.checked = true;
                    selectFreelancer(freelancerId, freelancerOption.closest('.freelancer-option'));
                }
            }
        });
    </script>
</body>
</html>
