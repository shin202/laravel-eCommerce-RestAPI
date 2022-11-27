<?php

    namespace App\Traits;

    trait ApiResponser {
        /**
         * Return a success response.
         * 
         * @param mixed $data
         * @param string|null $message
         * @param int $status_code
         * @return \Illuminate\Http\JsonResponse
         */
        protected function successReponse($data, $message = null, $status_code = 200) 
        {
            return response()->json([
                'status' => 'success',
                'message' => $message,
                'data' => $data,
            ], $status_code);
        }

        /**
         * 
         * 
         * @param mixed $data
         * @param string|null $message
         * @return \Illuminate\Http\JsonResponse
         */
        protected function successCreatedResponse($data, $message = 'Created Successfully.') {
            return response()->json([
                'status' => 'success',
                'message' => $message,
                'data' => $data,
            ], 201);
        }

        protected function userWrongCredentialsResponse($message = '') {
            return response()->json([
                'status' => 'error',
                'message' => $message
            ], 400);
        }

        protected function responseWithAccessToken($data, $accessToken, $message = '', $status_code = 200) {
            return response()->json([
                'status' => 'success',
                'message' => $message,
                'data' => [
                    'user' => $data,
                    'access_token' => [
                        'token_type' => 'Bearer',
                        'token' => $accessToken,
                        'expires_at' => now()->addMinute(env('SANCTUM_ACCESS_TOKEN_EXPIRES')),
                    ],
                ],
            ], $status_code);
        }

        protected function accessDeniedResponse($message = 'Access Denied') {
            return response()->json([
                'status' => 'error',
                'message' => $message,
            ], 403);
        } 
    }