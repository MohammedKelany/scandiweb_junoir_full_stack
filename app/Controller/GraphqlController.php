<?php

declare(strict_types=1);

namespace App\Controller;

use App\GraphQL\Types\MutationType;
use App\GraphQL\Types\QueryType;
use Configration\Config;
use GraphQL\Type\Schema;
use GraphQL\Type\SchemaConfig;
use GraphQL\Error\DebugFlag;
use GraphQL\GraphQL;
use RuntimeException;
use Src\Application;
use Src\Controller;
use Throwable;

class GraphQLController extends Controller
{
    /**
     * Handle GraphQL requests
     *
     * @return never
     */
    public static function handle(): never
    {
        try {
            Application::$app = new Application((new Config)->DB_CONFIG);
        } catch (Throwable $e) {
            error_log("Database connection error: " . $e->getMessage());
            http_response_code(500);
            echo json_encode([
                'errors' => [
                    ['message' => 'Database connection failed. Please check your configuration.']
                ]
            ]);
            exit;
        }

        try {
            // Initialize Query and Mutation Types
            $queryType = QueryType::handleQueryType();
            $mutationType = MutationType::handleMutationType();

            // Configure and Create Schema
            $schema = new Schema(
                (new SchemaConfig())
                    ->setQuery($queryType)
                    ->setMutation($mutationType)
            );

            // Get and Validate Input
            $rawInput = file_get_contents('php://input');
            if ($rawInput === false) {
                throw new RuntimeException('Failed to get php://input');
            }

            // Parse Input
            $input = json_decode($rawInput, true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new RuntimeException('Invalid JSON input: ' . json_last_error_msg());
            }

            $query = $input['query'] ?? null;
            if (!$query) {
                throw new RuntimeException('GraphQL query is required');
            }

            $variableValues = $input['variables'] ?? null;

            // Execute GraphQL Query
            $result = GraphQL::executeQuery(
                $schema,
                $query,
                null,
                ["db" => Application::$app->db],
                (array)$variableValues
            );

            $status = 200;
            $output = $result->toArray(
                DebugFlag::INCLUDE_DEBUG_MESSAGE | DebugFlag::INCLUDE_TRACE
            );
        } catch (Throwable $e) {
            error_log("GraphQL Error: " . $e->getMessage() . "\n" . $e->getTraceAsString());
            $output = [
                'errors' => [
                    [
                        'message' => $e->getMessage(),
                        'locations' => [],
                        'path' => [],
                    ]
                ]
            ];
            $status = 500;
        }

        // Send Response
        header('Content-Type: application/json; charset=UTF-8');
        http_response_code($status);
        echo json_encode($output, JSON_PRETTY_PRINT);
        exit;
    }
}
