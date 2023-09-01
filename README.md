1. Register New Account
    Endpoint: https://thefitapp.60dweb.com/api/auth/register
    Method: POST
    Request Body: {
        name: string, // required
        email: string, // required
        phone: string, // required
        passcode: Number, // optional
    }

    Response Body: 
        IF SUCCESS:
            {
                success:true,
                data: userObject
            }
        IF Failed:
            {
                success: false,
                message: errorMessage
            }


2. Send OTP After Registration
    Endpoint: https://thefitapp.60dweb.com/api/create-otp
    Method: POST
    Request Body: {
        email: string, // required
    }

    Response Body: 
        IF SUCCESS:
            {
                success:true,
                message: "OTP sent successfully"
            }
        IF Failed:
            {
                success: false,
                message: errorMessage
            }

3. Verify OTP for User verification
    Endpoint: https://thefitapp.60dweb.com/api/verify-otp
    Method: POST
    Request Body: {
        user_id: string, // required
        otp: string, // required
        login: boolean, // optional, only set true when login is required after OTP verification
    }

    Response Body: 
        IF SUCCESS:
            {
                success:true,
                message: "OTP sent successfully"
                data: userObject, // return with the login = true request only
                access_token: JWTToken, // return with the login = true request only
            }
        IF Failed:
            {
                success: false,
                message: errorMessage
            }


4. Set New Passcode
    Endpoint: https://thefitapp.60dweb.com/api/users
    Method: POST
    Request Body: {
        pass_code: number, // required
    }

    Headers: {
        Authorization: Barear JWTToken
    }

    Response Body: 
        IF SUCCESS:
            {
                success:true,
                data: userObject, 
            }
        IF Failed:
            {
                success: false,
                message: errorMessage
            }



5. Login API
    Endpoint: https://thefitapp.60dweb.com/api/auth/login
    Method: POST
    Request Body: {
        pass_code: number, // required
        user: string, // required, this must be either email or phone number.
    }

    Response Body: 
        IF SUCCESS:
            {
                success:true,
                data: userObject, 
                access_token: JWTToken
            }
        IF Failed:
            {
                success: false,
                message: errorMessage
            }


6. Get User Profile
    Endpoint: https://thefitapp.60dweb.com/api/users
    Method: GET
    Headers: {
        Authorization: Barear JWTToken
    }
    Response Body: 
        IF SUCCESS:
            {
                success:true,
                data: userObject, 
            }
        IF Failed:
            {
                success: false,
                message: errorMessage
            }

7. Update User Profile
    Endpoint: https://thefitapp.60dweb.com/api/user-update
    Method: POST
    Request Body: {
        pass_code: number, // optional
        phone: number, // optional
        name: string, // optional
        profile_pic: file, // optional
    }
    Headers: {
        Authorization: Barear JWTToken
    }
    Response Body: 
        IF SUCCESS:
            {
                success:true,
                data: userObject, 
            }
        IF Failed:
            {
                success: false,
                message: errorMessage
            }
            