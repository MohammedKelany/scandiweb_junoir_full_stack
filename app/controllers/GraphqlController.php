<?php

namespace App\controllers;

use App\graphql\types\MutationType;
use App\graphql\types\QueryType;
use GraphQL\Type\Schema;
use GraphQL\Type\SchemaConfig;
use GraphQL\Error\DebugFlag;
use GraphQL\GraphQL;
use RuntimeException;
use Src\Application;
use Src\Controller;
use Throwable;

class GraphqlController extends Controller
{
    public function handle()
    {
        try {
            // Query Type
            $queryType = QueryType::handleQueryType();

            // Mutation Type
            $mutationType = MutationType::handleMutationType();

            //Schema
            $schema = new Schema(
                (new SchemaConfig())
                    ->setQuery($queryType)
                    ->setMutation($mutationType)
            );

            $rawInput = file_get_contents('php://input');
            if ($rawInput === false) {
                throw new RuntimeException('Failed to get php://input');
            }

            $input = json_decode($rawInput, true);
            $query = $input['query'];
            $variableValues = $input['variables'] ?? null;

            $result = GraphQL::executeQuery(
                $schema,
                $query,
                null,
                ["db" => Application::$app->db],
                (array)$variableValues
            );

            $status = 200;
            $output = $result->toArray(DebugFlag::INCLUDE_DEBUG_MESSAGE | DebugFlag::INCLUDE_TRACE);
        } catch (Throwable $e) {
            $output = [
                'errors' => [
                    ['message' => $e->getMessage()],
                ],
            ];
            $status = 500;
        }

        header('Content-Type: application/json; charset=UTF-8');
        http_response_code($status);
        echo json_encode($output, JSON_PRETTY_PRINT);
        exit;
    }
}
