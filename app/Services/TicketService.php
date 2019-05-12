<?php

namespace App\Services;

use App\Models\Ticket;
use Carbon\Carbon;

class TicketService extends BaseService {
    /**
     * CompanyService constructor.
     * @param Station $busStation
     */
    public function __construct(Ticket $ticket)
    {
        $this->model = $ticket;
    }

    /**
     * @param $params
     * @return mixed
     */
    public function setParams($params)
    {
        $params['size'] = $params['size'] ?? config('setting.filter.size');
        $params['sort_field'] = $params['sort_field'] ?? config('setting.filter.sort_field');
        $params['sort_type'] = $params['sort_type'] ?? config('setting.filter.sort_type');

        return $params;
    }

    /**
     * @param array $params
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function search($params = [])
    {
        $params = $this->setParams($params);
        $query = $this->model->newQuery();

        if (!empty($params['user_id'])) {
            $query->where('user_id', $params['user_id']);
        }

        $query->with(['busRoute.route']);

        return $query->orderBy($params['sort_field'], $params['sort_type'])->paginate($params['size']);
    }

    public function createTicket($busRoute, $data)
    {
        $data['quantity'] = count($data['seat_number']);
        $data['seat_number'] = json_encode($data['seat_number']);
        $data['date_away'] = Carbon::createFromFormat(trans('main.date_format'), $data['date_away']);
        $data['total_price'] = $busRoute->price * $data['quantity'];

        return $busRoute->tickets()->create($data);
    }

    public function getTicket($id)
    {
        $ticket = $this->model->with(['busRoute.route'])->find($id);

        if (!$ticket) {
            throw new Exception("Moldel not found", 1);
        }

        return $ticket;
    }
}