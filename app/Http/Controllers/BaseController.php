<?php

namespace App\Http\Controllers;

use App\Exceptions\AuthorizationException;
use App\Exceptions\DuplicateScheduleException;
use App\Exceptions\ForbiddenException;
use App\Exceptions\NotFoundException;
use App\Exceptions\QueryException;
use App\Exceptions\ServerException;
use App\Exceptions\UnprocessableEntityException;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

abstract class BaseController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $repository;

    public function getKey($key)
    {
        return isset($key) ? $this->{$key}: $this->id;
    }


    /**
     * @param callable $callback
     * @param int      $code
     *
     * @return JsonResponse
     * @throws AuthorizationException
     * @throws ForbiddenException
     * @throws NotFoundException
     * @throws QueryException
     * @throws ServerException
     * @throws UnprocessableEntityException
     */
    protected function getData(callable $callback, int $code = Response::HTTP_OK): JsonResponse
    {
        try {
            $data = call_user_func_array($callback, []);

            return $this->renderJson($data, $code);
        } catch (UnprocessableEntityException $e) {
            throw new UnprocessableEntityException($e);
        } catch (QueryException $e) {
            throw new QueryException($e);
        } catch (NotFoundException $e) {
            throw new NotFoundException($e);
        } catch (AuthorizationException $e) {
            throw new AuthorizationException($e);
        } catch (ForbiddenException $e) {
            throw new ForbiddenException($e);
        } catch (\Exception $e) {
            throw new ServerException($e);
        }
    }


    /**
     * @param callable $callback
     * @param int      $code
     *
     * @return JsonResponse
     * @throws AuthorizationException
     * @throws ForbiddenException
     * @throws NotFoundException
     * @throws QueryException
     * @throws ServerException
     * @throws UnprocessableEntityException
     */
    protected function handleRequest(callable $callback, int $code = Response::HTTP_OK): JsonResponse
    {
        DB::beginTransaction();

        try {
            $results = call_user_func_array($callback, []);
            DB::commit();

            return $this->renderJson($results, $code);
        } catch (DuplicateScheduleException $e) {
            DB::rollBack();

            throw new DuplicateScheduleException($e);
        } catch (UnprocessableEntityException $e) {
            DB::rollBack();

            throw new UnprocessableEntityException($e);
        } catch (QueryException $e) {
            DB::rollBack();

            throw new QueryException($e);
        } catch (NotFoundException $e) {
            DB::rollBack();

            throw new NotFoundException($e);
        } catch (AuthorizationException $e) {
            DB::rollBack();

            throw new AuthorizationException($e);
        } catch (ForbiddenException $e) {
            DB::rollBack();

            throw new ForbiddenException($e);
        } catch (\Exception $e) {
            DB::rollBack();

            throw new ServerException($e);
        }
    }

    /**
     * @param mixed       $data
     * @param int         $statusCode
     * @param string|null $message
     *
     * @return JsonResponse
     */

    public function renderJson($data = [], int $statusCode = 200, string $message = ''): JsonResponse
    {
        return response()->json([
            'now'         => Carbon::now()->toDateTimeString(),
            'status_code' => $statusCode,
            'data'        => $data,
            'message'     => $message
        ]);
    }
}
