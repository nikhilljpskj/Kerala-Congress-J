<?php 
$pageTitle = 'Join Kerala Congress'; 
require_once __DIR__ . '/../layout/header.php'; 
?>

    <div class="header-bg">
        <div class="container">
            <h1 class="fw-bold mb-3">Become a Member</h1>
            <p class="lead mb-0 text-white-50">Join the movement and work with us for a better Kerala.</p>
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="form-card">
                    
                    <?php if(isset($message)): ?>
                        <div class="alert <?= strpos($message, 'Error') !== false ? 'alert-danger' : 'alert-success' ?> alert-dismissible fade show mb-4" role="alert">
                            <strong><i class="fas <?= strpos($message, 'Error') !== false ? 'fa-exclamation-triangle' : 'fa-check-circle' ?> me-2"></i></strong> <?= htmlspecialchars($message) ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <form action="<?= BASE_URL ?>/join" method="POST" enctype="multipart/form-data">
                        
                        <div class="text-center mb-4">
                            <p class="text-muted"><i class="fas fa-info-circle me-1"></i> All fields marked with <span class="text-danger">*</span> are mandatory.</p>
                        </div>

                        <div class="section-divider">Personal Details</div>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">First Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="fname" required placeholder="Enter first name">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Last Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="lname" required placeholder="Enter last name">
                            </div>
                            
                            <div class="col-md-6">
                                <label class="form-label">Mobile Number <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0">+91</span>
                                    <input type="tel" class="form-control border-start-0 ps-0" name="mobile" required pattern="[0-9]{10}" placeholder="10-digit number">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Email Address</label>
                                <input type="email" class="form-control" name="email" placeholder="example@email.com">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Date of Birth <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" name="dateofbirth" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Gender <span class="text-danger">*</span></label>
                                <select class="form-select" name="gender" required>
                                    <option value="" disabled selected>Select Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Name of Father/Guardian <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="fathername" required placeholder="Father/Guardian Name">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Aadhaar Number</label>
                                <input type="number" class="form-control" name="aadhaar" placeholder="12-digit Aadhaar">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Blood Group</label>
                                <select class="form-select" name="blood">
                                    <option value="" selected>Select Blood Group</option>
                                    <option value="A+">A+</option>
                                    <option value="A-">A-</option>
                                    <option value="B+">B+</option>
                                    <option value="B-">B-</option>
                                    <option value="O+">O+</option>
                                    <option value="O-">O-</option>
                                    <option value="AB+">AB+</option>
                                    <option value="AB-">AB-</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Reference Person</label>
                                <input type="text" class="form-control" name="reference" placeholder="Name of person who referred you">
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">Full Address <span class="text-danger">*</span></label>
                                <textarea class="form-control" name="address" rows="3" required placeholder="Enter your full residential address"></textarea>
                            </div>
                        </div>

                        <div class="section-divider">Party Affiliation & Location</div>

                        <div class="row g-3">
                            <div class="col-md-12">
                                <label class="form-label">Select Organization <span class="text-danger">*</span></label>
                                <select class="form-select" name="membership" id="membership" required onchange="setPresidentSecretary()">
                                    <option value="" disabled selected>Choose the organization you wish to join</option>
                                    <option value="Kerala Congress">Kerala Congress</option>
                                    <option value="Kerala Students Congress (KSC)">Kerala Students Congress (KSC)</option>
                                    <option value="Kerala Youth Front (KYF)">Kerala Youth Front (KYF)</option>
                                    <option value="Kerala IT & Professional Congress (KITPROC)">Kerala IT & Professional Congress (KITPROC)</option>
                                    <option value="Kerala Vanitha Congress">Kerala Vanitha Congress</option>
                                    <option value="Kerala Pravasi Congress">Kerala Pravasi Congress</option>
                                </select>
                                <input type="hidden" name="president" id="president">
                                <input type="hidden" name="secretary" id="secretary">
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">District <span class="text-danger">*</span></label>
                                <select class="form-select" name="district_id" id="district_id" required>
                                    <option value="" disabled selected>Select District</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Assembly Constituency <span class="text-danger">*</span></label>
                                <select class="form-select" name="assembly_id" id="assembly_id" required>
                                    <option value="" disabled selected>Select Assembly</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Ward / Local Body</label>
                                <select class="form-select" name="local_body_id" id="local_body_id">
                                    <option value="" disabled selected>Select Local Body</option>
                                </select>
                                <input type="text" class="form-control mt-2" name="ward" placeholder="Enter Ward No/Name Optional">
                            </div>
                            
                            <div class="col-12 mt-4">
                                <label class="form-label">Upload Photo (Max 2MB)</label>
                                <input type="file" class="form-control" name="photo" accept="image/jpeg, image/png">
                                <div class="form-text mt-2"><i class="fas fa-info-circle"></i> Please upload a clear passport size photograph (JPG or PNG format).</div>
                            </div>
                        </div>

                        <div class="mt-5 text-center">
                            <button type="submit" class="btn-submit">
                                <i class="fas fa-paper-plane me-2"></i> Submit Application
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
<script>
    (function() {
        const init = function() {
            const districtSelect = document.getElementById("district_id");
            const assemblySelect = document.getElementById("assembly_id");
            const localBodySelect = document.getElementById("local_body_id");

            if (!districtSelect) return;

            // Set loading state
            districtSelect.options[0].text = "Loading Districts...";

            console.log("Initializing joining form with BASE_URL:", typeof BASE_URL !== 'undefined' ? BASE_URL : 'UNDEFINED');
            const bUrl = typeof BASE_URL !== 'undefined' ? BASE_URL : '';

            // Fetch Districts
            fetch(bUrl + '/api/districts')
                .then(res => res.json())
                .then(data => {
                    districtSelect.options[0].text = "Select District";
                    console.log("Districts received:", data);
                    if(data.success && data.data) {
                        data.data.forEach(d => {
                            let option = new Option(d.name, d.id);
                            districtSelect.add(option);
                        });
                    }
                })
                .catch(err => {
                    districtSelect.options[0].text = "Error loading districts";
                    console.error("Error fetching districts:", err);
                });

            // Fetch Assemblies on District Change
            districtSelect.addEventListener("change", function() {
                assemblySelect.length = 1; // Reset
                localBodySelect.length = 1; // Reset
                if (!this.value) return;

                assemblySelect.options[0].text = "Loading Assemblies...";

                fetch(bUrl + '/api/assemblies?district_id=' + this.value)
                    .then(res => res.json())
                    .then(data => {
                        assemblySelect.options[0].text = "Select Assembly";
                        if(data.success && data.data) {
                            data.data.forEach(a => {
                                let option = new Option(a.name, a.id);
                                assemblySelect.add(option);
                            });
                        }
                    })
                    .catch(err => {
                        assemblySelect.options[0].text = "Error loading assemblies";
                        console.error("Error fetching assemblies:", err);
                    });
            });

            // Fetch Local Bodies on Assembly Change
            assemblySelect.addEventListener("change", function() {
                localBodySelect.length = 1; // Reset
                if (!this.value) return;

                localBodySelect.options[0].text = "Loading Local Bodies...";

                fetch(bUrl + '/api/local-bodies?assembly_id=' + this.value)
                    .then(res => res.json())
                    .then(data => {
                        localBodySelect.options[0].text = "Select Local Body";
                        if(data.success && data.data) {
                            data.data.forEach(lb => {
                                let option = new Option(lb.name, lb.id);
                                localBodySelect.add(option);
                            });
                        }
                    })
                    .catch(err => {
                        localBodySelect.options[0].text = "Error loading local bodies";
                        console.error("Error fetching local bodies:", err);
                    });
            });
        };

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', init);
        } else {
            init();
        }
    })();

    function setPresidentSecretary() {
        var membership = document.getElementById('membership').value;
        var presidentField = document.getElementById('president');
        var secretaryField = document.getElementById('secretary');

        if (membership === 'Kerala IT & Professional Congress (KITPROC)') {
            presidentField.value = 'Apu John Joseph';
            secretaryField.value = 'Jais John Vettiyar';
        } else if (membership === 'Kerala Youth Front (KYF)') {
            presidentField.value = 'KV Kannan';
            secretaryField.value = '-';
        } else {
            presidentField.value = '-';
            secretaryField.value = '-';
        }
    }
</script>
<?php require_once __DIR__ . '/../layout/footer.php'; ?>
