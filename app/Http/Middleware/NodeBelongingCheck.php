<?php

namespace App\Http\Middleware;

use Closure;
use App\Node;

class NodeBelongingCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
    	if (!($node = Node::where('id',$request->id)->first())){
    		return formatter(404,__('node.node_no_found'));
	    }

	    if (!($node->nodeGroup()->where('user_id',$request->user()->id)->first())){
		    return formatter(403,('node.node_does_not_belong_to_user'));
	    }

        return $next($request);
    }
}
