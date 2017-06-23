<?php

namespace App\Http\Middleware;

use Closure;
use App\Node;

class NodeBelongingCheck
{
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  \Closure $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		if (!($node = Node::where('id', $request->nid)->first())) {
			return formatter(404, __('node.node_no_found'));
		}

		if ($request->currentServiceModel->NodeGroup()->first()->nodes()->where('id',$request->nid)->first()) {
			$request->merge(['currentNodeModel' => $node]);

			return $next($request);
		}

		return formatter(403, ('node.node_does_not_belong_to_user'));

	}
}
