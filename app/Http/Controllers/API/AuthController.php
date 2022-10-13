<?php
namespace App\Http\Controllers\API;

use App\Models\User;
use App\Models\PhonePassowrd;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailNotify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Dotunj\LaraTwilio\Facades\LaraTwilio;
use Twilio\Exceptions\TwilioException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{

    /**
     *
     * @OA\Post(
     * path="/user/register",
     * operationId="userRegister",
     * tags={"users"},
     * summary="user register",
     * description="user register",
     * security={{ "basicAuth": {} }},
     *      @OA\RequestBody(
     *       @OA\MediaType(
     *           mediaType="multipart/form-data",
     *           @OA\Schema(
     *              required={"first_name","email","password","last_name","phone","country_code"},
     *              @OA\Property(property="first_name", type="string", format="name", example="test"),
     *              @OA\Property(property="last_name", type="string", format="name", example="test"),
     *              @OA\Property(property="email", type="string", format="email", example="user1@mail.com"),
     *              @OA\Property(property="password", type="string", format="password", example="password2"),
     *              @OA\Property(property="phone", type="string", format="string", example="345435"),
     *              @OA\Property(property="country_code", type="string", format="string", example="91")
     *           ),
     *       ),
     *   ),
     *
     * @OA\Response(
     *    response=422,
     *    description="Validator Error"
     *     ),
     * @OA\Response(
     *    response=401,
     *    description="Authentication Error",
     *    @OA\JsonContent(
     *          @OA\Property(property="message", type="string", example="Something went wrong"),
     *      )
     *     ),
     * @OA\Response(
     *    response=200,
     *    description="Success",
     *    @OA\JsonContent(
     *          @OA\Property(property="message", type="string", example="OTP sent to user@gmail.com"),
     *          @OA\Property(property="user", type="string", example="User details"),
     *      )
     *     ),
     * )
     */
    public function register(Request $request)
    {
        $fields = $request->all();

        $validator = Validator::make($fields, [
            'first_name' => 'required|string',
            'email' => 'required|string|unique:users,email|email:rfc,dns',
            'phone' => 'required|string|unique:users,phone',
            'country_code' => 'required|string',
            'last_name' => 'required|string',
            'password' => [
                'required',
                'string',
                'min:8'
            ]
        ]);
        if ($validator->fails()) {
            return response([
                "status" => 422,
                'message' => $validator->errors()
            ]);
        }
        $createUSer = [
            'name' => $fields['first_name'] . ' ' . $fields['last_name'],
            'email' => $fields['email'],
            'role' => 1,
            'country_code' => $fields['country_code'],
            'phone' => $fields['phone'],
            'password' => Hash::make($request['password'])
        ];

        $createUSer['otp'] = mt_rand(1000, 9999);

        if ($user = User::create($createUSer)) {

            $mail_details = [
                'subject' => 'Register Application OTP',
                'body' => 'Your OTP is : ' . $user->otp
            ];

            try {

                // Mail::to($request->email)->send(new MailNotify($mail_details));
                $responseMessage = 'OTP sent to ' . $user->email;
            } catch (\Exception $e) { // Using a generic exception
                $responseMessage = $e->getMessage();
            }

            $response = [
                'message' => $responseMessage,
                'user' => $user,
                'otp' => $createUSer['otp']
            ];
        }
        return response($response, 201);
    }

    /**
     *
     * @OA\Post(
     * path="/user/login",
     * operationId="userLogin",

     * tags={"users"},
     * summary="user login",
     * description="user login",
     * security={{ "basicAuth": {} }},
     *      @OA\RequestBody(
     *       @OA\MediaType(
     *           mediaType="multipart/form-data",
     *           @OA\Schema(
     *              required={"email","password"},
     *              @OA\Property(property="password", type="string", format="password", example="password2"),
     *              @OA\Property(property="email", type="email", format="email", example="hello@toxsl.com")
     *           ),
     *       ),
     *   ),
     *
     * @OA\Response(
     *    response=422,
     *    description="Validator Error"
     *     ),
     * @OA\Response(
     *    response=401,
     *    description="Authentication Error",
     *    @OA\JsonContent(
     *          @OA\Property(property="message", type="string", example="Something went wrong"),
     *      )
     *     ),
     * @OA\Response(
     *    response=200,
     *    description="Success",
     *    @OA\JsonContent(
     *          @OA\Property(property="message", type="string", example="login successfully"),
     *          @OA\Property(property="user", type="string", example="User details"),
     *      )
     *     ),
     * )
     */
    public function login(Request $request)
    {
        
        $fields = $request->all();
        
        $validator = Validator::make($fields, [
            'email' => 'required',
            'password' => 'required|string'
        ]);
        if ($validator->fails()) {

            return response([
                "status" => 422,
                'message' => $validator->errors()
            ]);
        }

        $user = User::where('email', $fields['email'])->first();

        // Check password
        if (! $user || ! Hash::check($fields['password'], $user->password)) {
            return response([
                'message' => 'Password or Email is Incorrect!'
            ], 401);
        }

        if ($user->otp_verified != 1) {
            return response([
                'message' => 'Please verify your account'
            ], 401);
        }

        $token = $user->createToken('authToken')->plainTextToken;
        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    /**
     *
     * @OA\post(
     * path="/user/verify_otp",
     * summary="user otp verification",
     * description="user verify",
     * operationId="user_verify_otp",
     * tags={"users"},
     * security={{ "basicAuth": {} }},
     *      @OA\RequestBody(
     *       @OA\MediaType(
     *           mediaType="multipart/form-data",
     *           @OA\Schema(
     *              required={"otp","phone","country_code"},
     *              @OA\Property(property="otp", type="integer", format="number", example="1234"),
     *              @OA\Property(property="phone", type="string", format="number", example="34534534535",description="conatct number"),
     *              @OA\Property(property="country_code", type="integer", format="number", example="91",description="country code"),
     *           ),
     *       ),
     *   ),
     *
     * @OA\Response(
     *    response=200,
     *    description="Success",
     *    @OA\JsonContent(
     *    @OA\Property(property="message", type="string", example="Otp verified"),
     *        )
     * ),
     * @OA\Response(
     *    response=401,
     *    description="Not Found",
     *    @OA\JsonContent(
     *    @OA\Property(property="message", type="string", example="Something went wrong"),
     *        )
     * ),
     *     )
     * )
     */
    public function verifyOtp(Request $request)
    {
        if (! ($request->has('phone'))) {
            return response([
                "status" => 422,
                'message' => 'phone number is required'
            ]);
        }
        if (! $request->has('otp')) {
            return response([
                "status" => 422,
                'message' => 'otp is required'
            ]);
        }

        $user = User::where('phone', $request->phone)->first();

        if ($user) {
            if ($user->otp == $request->otp) {
                $user->otp_verified = 1;
                $user->save();

                $accessToken = $user->createToken('access_token')->plainTextToken;

                return response()->json([
                    'user' => $user,
                    'token' => $accessToken
                ], 200);
            } else {
                return response()->json([
                    'message' => 'The code your provided is wrong.'
                ], 401);
            }
        } else {
            return response()->json([
                'message' => 'No such account found .'
            ], 401);
        }
    }

    /**
     *
     * @OA\post(
     * path="/user/password/forgot",
     * summary="user forget password",
     * description="user forget password",
     * operationId="user_forget_password",
     * tags={"users"},
     * security={{ "basicAuth": {} }},
     * @OA\RequestBody(
     * required=true,
     * @OA\JsonContent(
     * required={"email"},
     * @OA\Property(property="email", type="string", format="email", example="user1@mail.com")
     *   )
     * ),
     * @OA\Response(
     *    response=200,
     *    description="Success",
     *    @OA\JsonContent(
     *    @OA\Property(property="status", type="integer", example="We have emailed your password reset link!"),
     *        )
     * ),
     * @OA\Response(
     *    response=401,
     *    description="Not Found",
     *    @OA\JsonContent(
     *    @OA\Property(property="message", type="string", example="Something went wrong"),
     *        )
     * ),
     *     )
     * )
     */
    public function sendPasswordResetLink(Request $request)
    {
        if ($request->has('email')) {

            $request->validate([
                'email' => 'required|email'
            ]);

            $user = User::where([
                [
                    'email',
                    '=',
                    $request->email
                ]
            ])->first();

            if ($user) {

                $token = mt_rand(10000, 99999);
                $create = [
                    'email_phone' => $request->email,
                    'token' => $token,
                    'method' => 'email'
                ];

                if (PhonePassowrd::updateOrCreate([
                    'email_phone' => $user->email
                ], $create)) {

                    $mail_details = [
                        'subject' => 'Forgot Password OTP',
                        'body' => 'Your OTP is : ' . $token
                    ];

                    try {

                        // Mail::to($request->email)->send(new MailNotify($mail_details));
                        $responseMessage = 'Forgot Password OTP sent to ' . $user->email;
                    } catch (\Exception $e) { // Using a generic exception
                        $responseMessage = $e->getMessage();
                    }

                    $response = [
                        'message' => $responseMessage
                    ];

                    return response()->json($response, 201);
                }
            }
            return response()->json([
                'message' => 'User does not exists!'
            ], 404);
        } elseif ($request->has('phone_number')) {

            $request->validate([
                'phone_number' => 'required|string'
            ]);

            $user = User::where([
                [
                    'phone_number',
                    '=',
                    $request->phone_number
                ]
            ])->first();

            if ($user) {

                $token = mt_rand(10000, 99999);
                $create = [
                    'email_phone' => $request->phone_number,
                    'token' => $token,
                    'method' => 'phone_number'
                ];

                if (PhonePassowrd::updateOrCreate([
                    'email_phone' => $user->phone_number
                ], $create)) {

                    try {
                        $message = 'Your OTP is : ' . $token;
                        LaraTwilio::notify($request->phone_number, $message);
                        $responseMessage = 'Password reset otp sent to ' . $user->phone_number;
                    } catch (TwilioException $e) {

                        $responseMessage = $e->getMessage();
                    }

                    $response = [
                        'message' => $responseMessage
                    ];

                    return response()->json($response, 201);
                }
            }
            return response()->json([
                'message' => 'User does not exists!'
            ], 404);
        } else {
            return response()->json([
                'message' => 'Invalid Request!'
            ], 401);
        }
    }

    public function verifyForgotPasswordOtp(Request $request)
    {
        if ($request->has('email')) {

            $checkToken = PhonePassowrd::where([
                [
                    'email_phone',
                    '=',
                    $request->email
                ],
                [
                    'token',
                    '=',
                    $request->otp
                ],
                [
                    'method',
                    '=',
                    'email'
                ]
            ])->first();
        } else if ($request->has('phone_number')) {

            $checkToken = PhonePassowrd::where([
                [
                    'email_phone',
                    '=',
                    $request->phone_number
                ],
                [
                    'token',
                    '=',
                    $request->otp
                ],
                [
                    'method',
                    '=',
                    'phone_number'
                ]
            ])->first();
        }

        if ($checkToken) {

            if ($request->has('email')) {
                $user = User::where([
                    [
                        'email',
                        '=',
                        $request->email
                    ]
                ])->first();
            } elseif ($request->has('phone_number')) {
                $user = User::where([
                    [
                        'phone_number',
                        '=',
                        $request->phone_number
                    ]
                ])->first();
            }

            if ($user) {

                User::where('id', '=', $user->id)->update([
                    'is_verified' => 1
                ]);
                $accessToken = $user->createToken('access_token')->plainTextToken;

                $checkToken->delete();
                return response()->json([
                    'user' => $user,
                    'token' => $accessToken
                ], 200);
            } else {

                return response()->json([
                    'message' => 'Invaild User'
                ], 401);
            }
        }
        return response()->json([
            'message' => 'The code your provided is wrong.'
        ], 401);
    }

    /**
     *
     * @OA\Post(
     * path="/user/resend_otp",
     * summary="user resend otp",
     * description="user reset otp",
     * operationId="userReset",
     * tags={"users"},
     * security={{ "basicAuth": {} }},
     * @OA\RequestBody(
     * required=true,
     * @OA\JsonContent(
     * required={"otp"},
     * @OA\Property(property="email", type="string", format="email", example="user1@mail.com"),
     * @OA\Property(property="phone_number", type="string", example="123455"),
     * @OA\Property(property="otp", type="string", example="1234"),
     *   )
     * ),
     * @OA\Response(
     *    response=200,
     *    description="Success",
     *    @OA\JsonContent(
     *    @OA\Property(property="status", type="integer", example="Otp is sent successfully!"),
     *        )
     * ),
     * @OA\Response(
     *    response=401,
     *    description="Not Found",
     *    @OA\JsonContent(
     *    @OA\Property(property="message", type="string", example="Something went wrong"),
     *        )
     * ),
     *     )
     * )
     */
    public function resendOtp(Request $request)
    {
        if ($request->has('email')) {

            $fields = $request->validate([
                'email' => 'required|string|email|email:rfc,dns'
            ]);

            $user = User::where('email', $fields['email'])->first();
        } else if ($request->has('phone_number')) {

            $fields = $request->validate([
                'phone_number' => 'required|string'
            ]);

            $user = User::where('phone_number', $fields['phone_number'])->first();
        }
        if ($user) {
            $user->otp = mt_rand(10000, 99999);

            if ($user->save()) {

                if ($request->has('email')) {

                    $mail_details = [
                        'subject' => 'Register Application OTP',
                        'body' => 'Your OTP is : ' . $user->otp
                    ];

                    try {

                        // Mail::to($request->email)->send(new MailNotify($mail_details));
                        $responseMessage = 'OTP sent to ' . $user->email;
                    } catch (\Exception $e) { // Using a generic exception
                        $responseMessage = $e->getMessage();
                    }

                    $response = [
                        'message' => $responseMessage
                    ];
                } else if ($request->has('phone_number')) {

                    $message = 'Your OTP is : ' . $user->otp;

                    try {

                        // LaraTwilio::notify($request->phone_number, $message);
                        $responseMessage = 'OTP sent to ' . $user->phone_number;
                    } catch (TwilioException $e) {

                        $responseMessage = $e->getMessage();
                    }

                    $response = [
                        'message' => $responseMessage
                    ];
                }
            } else {

                return response([
                    "status" => 401,
                    'message' => 'Something Went Wrong'
                ]);
            }
            return response($response, 201);
        }
        return response([
            "status" => 404,
            'message' => 'User does not exists!'
        ]);
    }

    /**
     *
     * @OA\Post(
     * path="/user/profile/update",
     * summary=" user profile update",
     * description="user profile update",
     * operationId="userProfileUpdate",
     * tags={"users"},
     * security={{ "sanctum": {} }},
     * @OA\RequestBody(
     * required=true,
     * @OA\MediaType(
     *   mediaType="multipart/form-data",
     *   @OA\Schema(
     *   @OA\Property(description="file to upload",property="profile_picture",type="file"),
     *   @OA\Property(property="phone_number", type="string", example="123455"),
     *   @OA\Property(property="first_name", type="string", example="arun"),
     *   @OA\Property(property="last_name", type="string", example="kumar"),
     *   @OA\Property(property="country_code", type="string", example="91"),
     *   @OA\Property(property="country", type="number", example="india"),
     *   @OA\Property(property="gender", type="string", example="male"),
     *   @OA\Property(property="dob", type="string", format="date", example="1988-01-01"),
     *   required={"profile_picture","dob","phone_number","first_name","last_name","country_code","country","gender"} )),
     * ),
     * @OA\Response(
     *    response=200,
     *    description="Success",
     *    @OA\JsonContent(
     *    @OA\Property(property="status", type="integer", example="Profile  Updated successfully!"),
     *        )
     * ),
     * @OA\Response(
     *    response=401,
     *    description="Not Found",
     *    @OA\JsonContent(
     *    @OA\Property(property="message", type="string", example="Something went wrong"),
     *        )
     * ),
     *     )
     * )
     */
    public function profileUpdate(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'gender' => 'required|string|in:male,female,other',
            'dob' => 'required|date',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'country_code' => 'required|string'
        ]);

        $user->gender = $request->gender;
        $user->dob = $request->dob;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->country_code = $request->country_code;

        if ($request->hasFile('profile_picture')) {
            $imageName = date('Ymd') . '_' . time() . '.' . $request->file('profile_picture')->getClientOriginalExtension();
            $request->profile_picture->move(public_path('uploads/'), $imageName);
            $user->profile_picture = $imageName;
        }

        if ($user->save()) {
            return response()->json([
                "message" => "Profile updated successfully",
                'user' => $user
            ], 200);
        }

        return response([
            "status" => 404,
            'message' => 'User does not exists!'
        ]);
    }

    /**
     *
     * @OA\Post(
     * path="/user/change-password",
     * summary=" user change password",
     * description="user change password",
     * operationId="userChangePassword",
     * tags={"users"},
     * security={{ "sanctum": {} }},
     *      @OA\RequestBody(
     *       @OA\MediaType(
     *           mediaType="application/json",
     *           @OA\Schema(
     *              required={"old-password","password","password_confirmation"},
     *              @OA\Property(property="old-password", type="string", format="password", example="secret123"),
     *              @OA\Property(property="password", type="string", format="password", example="secret1234"),
     *              @OA\Property(property="password_confirmation", type="string", format="password", example="secret1234"),
     *           ),
     *       ),
     *   ),
     * @OA\Response(
     *    response=200,
     *    description="Success",
     *    @OA\JsonContent(
     *    @OA\Property(property="status", type="integer", example="Profile  Updated successfully!"),
     *        )
     * ),
     * @OA\Response(
     *    response=401,
     *    description="Not Found",
     *    @OA\JsonContent(
     *    @OA\Property(property="message", type="string", example="Something went wrong"),
     *        )
     * ),
     *     )
     * )
     */
    public function changePassword(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'old-password' => [
                'required',
                function ($attribute, $value, $fail) use ($user) {
                    if (! Hash::check($value, $user->password)) {
                        $fail('Old password does not match.');
                    }
                }
            ],
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed'
            ],
            'password_confirmation' => 'required|same:password'
        ]);

        $user->password = Hash::make($request['password']);
        if ($user->save()) {
            return response()->json([
                "message" => "Password changed successfully",
                'user' => $user
            ], 200);
        }
    }
    
}
