<?php  
$csslink = "../assets/css/style.css";
$title = "My Profile";

function get_content() { 
    $id = $_SESSION["user_details"]["user_id"];
	require_once '../controllers/connection.php';
	$query = "SELECT * FROM users WHERE user_id = ?";
	$stmt = $cn->prepare($query);
	$stmt->bind_param("i", $id);
	$stmt->execute();
	$result = $stmt->get_result();
    $user = $result->fetch_assoc();
?>

<div class="container">
	<div class="row">
		<div class="col-md-4 py-5 mx-auto">
            <div class="card">
                <img src="<?php echo $user['profile_picture'] ?>" class="card-img-top mx-auto mt-3" id="myprofile-img">
				<div class="card-body">
					<p class="card-text text-center">First Name: <?php echo $user['firstname'] ?></p>
					<p class="card-text text-center">Last Name: <?php echo $user['lastname'] ?></p>
					<p class="card-text text-center">Email: <?php echo $user['email'] ?></p>
					<p class="card-text text-center">Birthday: <?php echo $user['birthday'] ?></p>
				</div>

				<div class="card-footer">
					<button class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#editModal">Edit</button>

					<div class="modal fade" id="editModal">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title">Edit Profile</h5>
								</div>
								<div class="modal-body">
									<form method="POST" action="/controllers/users/edituser.php" enctype="multipart/form-data">
										<input type="hidden" name="id" value="<?php echo $user['user_id'] ?>">
										<div class="mb-3">
                                            <label>Profile Picture</label>
                                            <input type="file" name="image" class="form-control" value="<?php echo $user['profile_picture'] ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label>Firstname</label>
                                            <input type="text" name="firstname" class="form-control" value="<?php echo $user['firstname'] ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label>Lastname</label>
                                            <input type="text" name="lastname" class="form-control" value="<?php echo $user['lastname'] ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label>Email</label>
                                            <input type="email" name="email" class="form-control" value="<?php echo $user['email'] ?>">
                                        </div>
										<button class="btn btn-primary">Submit</button>
									</form>
								</div>
								<div class="modal-footer">
									<button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
								</div>
							</div>
						</div>
					</div>

					<button class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">Delete</button>

					<div class="modal fade" id="deleteModal">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title">Are you sure you want to delete your account?</h5>
								</div>
								<div class="modal-footer">
									<a href="/controllers/users/deleteuser.php?id=<?php echo $user['user_id']; ?>" class="btn btn-success">Confirm</a>
									<button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
								</div>
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>

<?php  
	}
	require_once 'partials/layout.php';
?>